
<?php
include "checkLogin.php";

checkIfAllowed();
/*
the function is for checking if you are allowed to watch the stats
input: none
output: none
*/

function checkIfAllowed()
{
	$db = new SQLite3("database.db");
	$insertString = "SELECT guid FROM _users where uName=? AND uPass=?";
	$statement = $db->prepare($insertString);
	$statement->bindValue(1, $_SESSION["username"]);
	$statement->bindValue(2, $_SESSION["password"]);
	$result = $statement->execute();
	$row = $result->fetchArray(SQLITE3_ASSOC) ["guid"];
	$guidsArr = explode("&&", $row);
	$allowed = array(
		"Tamir",
		"Ziv",
		"Omri"
	);
	if (!in_array($_SESSION['username'], $allowed) && !in_array($_GET["guid"], $guidsArr))
	{
		header('Location: ' . "menu.php");
		exit();
	}
}

?>

<html>
    <head>
        <title>Stats</title>

			<meta charset="utf-8">
			<script src="menu.js"></script>
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link rel="stylesheet" href="bootstrap.css">
			<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>

    </head> 
<body id = "TheBody">
<?php include "back.php";?>

    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-7 col-md-9">
            <div class="card shadow-lg">
                <div class="card-body p-4 p-md-5">
                    <h3>Link to answer the form:</h3>
                    <input type="text" class="form-control" disabled value="
<?php
echo "IP/answerQuery.php?id=" . $_GET['guid'];
?>">
                    <center>
                        <h3>Here is the Statistics for the selected form:</h3><br />
                    </center>
                    <?php

/*
the function is for counting the number of question
input: none
output: the number of question
*/
function getNumOfQuestion()
{
	return count(getQuestionArr());
}

/*
the function is for getting the question Array
input: none
output: array of question
*/
function getQuestionArr()
{
	$arr = array();
	$i = 0;
	$db = new SQLite3("database.db");
	$selectString = "SELECT * FROM _queries WHERE formGUID=?";
	$statement = $db->prepare($selectString);
	$statement->bindValue(1, $_GET["guid"]);
	$result = $statement->execute();
	while ($row = $result->fetchArray(SQLITE3_ASSOC))
	{
		$arr[$i] = $row;
		$i++;
	}

	$db->close();
	return $arr;
}

/*
the function is for retunring the answers db
input: question number, question arr
output: the db enrties of the answers
*/
function getValues($number, $questionArr)
{
	$arr = array();
	$i = 0;
	$db = new SQLite3("database.db");
	$selectString = "SELECT * FROM _answers WHERE formGUID=? AND qNum=?";
	$statement = $db->prepare($selectString);
	$statement->bindValue(1, $_GET["guid"]);
	$statement->bindValue(2, $number);
	$result = $statement->execute();
	while ($row = $result->fetchArray(SQLITE3_ASSOC))
	{
		$arr[$i] = $row;
		$i++;
	}

	$db->close();
	return $arr;
}

/*
the function is for retunring the answers from the big array
input: array of answers
output: the array of just the answers
*/
function arrayOfAns($valuesArr)
{
	$arr = array();
	$len1 = count($valuesArr);
	for ($i = 0; $i < $len; $i++)
	{
		$ans = explode(",", $valuesArr[$i]["answer"]);
		$len2 = count($ans);
		for ($j = 0; $j < $len2; $j++)
		{
			if (isset($arr[$ans[$j]]))
			{
				$arr[$ans[$j]]++;
			}
			else
			{
				$arr[$ans[$j]] = 1;
			}
		}
	}

	return $arr;
}

/*
the function is creating a table for specific question
input: question number and array
output: none
*/
function addTable($number, $arr)
{
	$valueArr = getValues($number, $arr);
	if (count($valueArr) > 0)
	{
		echo "<center>";
		echo "<table border=1>";
		$len = count($valueArr);
		for ($i = 0; $i < $len; $i++)
		{
			echo "<tr>";
			echo "<td> <h3>" . htmlspecialchars($valueArr[$i]["clientID"], ENT_QUOTES, 'UTF-8') . "</h3></td>";
			echo "<td> <h3>" . htmlspecialchars($valueArr[$i]["answer"], ENT_QUOTES, 'UTF-8') . "</h3></td>";
			echo "</tr>";
		}

		echo "</table>";
		echo "</center>";
	}
	else
	{
		echo "<center><h4>no such answers to this question</h4></center>";
	}
}

/*
the function is creating a table for all the question
input: array of questions
output: none
*/
function answerTable($QuestArr)
{
	echo "<center>";
	echo "<h1> all the answers</h1>";
	echo "<table border=1>";
	for ($number = 1; $number <= getNumOfQuestion(); $number++)
	{
		$arr = getValues($number, $QuestArr);
		if (count($arr) > 0)
		{
			for ($i = 0; $i < count($arr); $i++)
			{
				echo "<tr>
                <td><h3>" . $arr[$i]['clientID'] . "</h3></td>
                                    <td><h3>" . $arr[$i]['qnum'] . "</h3></td>
                                    <td><h3>" . $arr[$i]['answer'] . "</h3></td>
                                    </tr>";
			}
		}
		else
		{
			echo "<tr><td><h4>no such answers to question number $number</h4></td></tr>";
		}
	}

	echo "</table>";
	echo "</center>";
}

/*
the function for getting the pie diag
input: array of values and id
output: none
*/
function getPie($arr, $id)
{
	if (count($arr) != 0)
	{
		echo "<center>";
		echo '<canvas id="myChart' . $id . '" width="500" height="500"></canvas>';
		echo '<script>
        var ctx = document.getElementById("myChart' . $id . '").getContext("2d");
                            var myChart = new Chart(ctx, {
                                type: "pie",
                                data: {
                                    labels:';
		echo ' [';
		foreach($arr as $key => $value)
		{
			echo '"' . $key . '",';
		}

		echo '],
                                    datasets: [{
                                        label: [';
		foreach($arr as $key => $value)
		{
			echo '"' . $key . '",';
		}

		echo "],";
		echo "data: [";
		foreach($arr as $value)
		{
			echo "$value,";
		}

		echo "],";
		echo "backgroundColor: [
            'rgba(255, 99, 132, 0.8)',
            'rgba(54, 162, 235, 0.8)',
            'rgba(255, 206, 86, 0.8)',
                                    'rgba(75, 192, 192, 0.8)',
                                    'rgba(153, 102, 255,0.8)',
                                    'rgba(255, 159, 64, 0.8)'
                                ],
                                
                                borderWidth: 0.5
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                            }
                                        }]
                                    },
                                    responsive: false
                                    
                                }
                            });
                            </script>";
	}
	else
	{
		echo "<center><h4>no such answers to this question</h4></center>";
	}
}

//the main function for adding all the stats
function main()
{
	for ($number = 1; $number <= getNumOfQuestion(); $number++)
	{
		$arr = getQuestionArr();
		if ($arr[$number - 1]["type"] == "checkbox" || $arr[$number - 1]["type"] == "radio")
		{
			echo '<center><h3>' . $arr[$number - 1]["question"] . '</h3></center>';
			$arr = getValues($number, $arr);
			getPie(arrayOfAns($arr) , $number);
		}
		else
		{
			echo '<center><h3>' . $arr[$number - 1]["question"] . '</h3></center>';
			addTable($number, $arr);
		}
	}

	answerTable($arr);
}

main();
?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>