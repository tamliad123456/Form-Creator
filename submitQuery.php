<?php
include 'checkLogin.php';
 ?>
<html>
    <head>
                <title>create a query</title>

                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <link rel="stylesheet" href="bootstrap.css">
        </head>
<body id = "TheBody">

    <?php
/*
the function is for getting the params of checkbox and radio
input: question number
output: none
*/
function parseParams($number)
{
	$i = 2;
	$string = $_POST["$number&&option1"];
	do
	{
		if($_POST["$number&&option$i"] != "")
		{
			$string = "$string&&";
			$string = $string . $_POST["$number&&option$i"];
			$i++;
		}
	}

	while (isset($_POST["$number&&option$i"]));
	return $string;
}

/*
the function is for sending the query to the db
input: array of question, question number
output: none
*/
function sendQuery($arr, $i)
{
	$insertString = "INSERT INTO _queries(qNum, question, parms, type, formGUID) VALUES(?,?,?,?,?)";
	$db = new SQLite3("database.db");
	$statement = $db->prepare($insertString);
	$statement->bindValue(1, $arr["qNum"]);
	$statement->bindValue(2, $arr["question"]);
	$statement->bindValue(3, $arr["params"]);
	$statement->bindValue(4, $arr["type"]);
	$statement->bindValue(5, $arr["GUID"]);
	$statement->execute();
	$db->close();
}

/*
the function is for getting the form the user has on his account
input: db
output: none
*/
function getUserForms($db)
{
	$username = $_SESSION["username"];
	$password = $_SESSION["password"];
	$getQuery = "SELECT guid FROM _users WHERE uName=? AND uPass=?";
	$statement = $db->prepare($getQuery);
	$statement->bindValue(1, $username);
	$statement->bindValue(2, $password);
	$result = $statement->execute();
	$row = $result->fetchArray(SQLITE3_ASSOC);
	if (isset($row["guid"]))
	{
		return $row["guid"];
	}
	else
	{
		return "";
	}
}

//the main function responsible to send all the question to the db
function main()
{	
	$i = 1;
	$toSub = 0;
	$questionArr = array();
	$GUID = uniqid();
	do
	{
		if (isset($_POST["q{$i}input"]))
		{
			$questionArr["question"] = $_POST["q{$i}input"];
			$questionArr["type"] = "input";
			$questionArr["params"] = "";
		}
		else
		if (isset($_POST["q{$i}radio"]))
		{
			$questionArr["question"] = $_POST["q{$i}radio"];
			$questionArr["type"] = "radio";
			$questionArr["params"] = parseParams("q$i");
		}
		else
		if (isset($_POST["q{$i}checkbox"]))
		{
			$questionArr["question"] = $_POST["q{$i}checkbox"];
			$questionArr["type"] = "checkbox";
			$questionArr["params"] = parseParams("q$i");
		}
		else
		{

			// PLACEHOLDER for banning

		}

		if($questionArr["question"] != "")
		{
			$questionArr["GUID"] = $GUID;
			$questionArr["qNum"] = $i - $toSub;
			$stringToInsert = sendQuery($questionArr, $i);
		}
		else
		{
			$toSub++;
		}
		$i++;
	}

	while (isset($_POST["q{$i}input"]) || isset($_POST["q{$i}checkbox"]) || isset($_POST["q{$i}radio"]));
	if($i - 1 != $toSub)
	{
		$db = new SQLite3("database.db");
		$guids = getUserForms($db);
		$insertString = "UPDATE _users SET guid=? WHERE uName=? AND uPass=?";
		$statement = $db->prepare($insertString);
		if ($guids != "")
		{
			$statement->bindValue(1, "$guids&&$GUID");
		}
		else
		{
			$statement->bindValue(1, "$GUID");
		}

		$statement->bindValue(2, $_SESSION["username"]);
		$statement->bindValue(3, $_SESSION["password"]);
		$result = $statement->execute();
		$db->close();
	}
	header("Location: menu.php");
	
	exit;
}

main();
?>

</body>
</html>