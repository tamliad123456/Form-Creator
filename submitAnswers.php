
<html>
    <head>
        <title>Answer</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="bootstrap.css">
    </head>
    <body>
        <?php
include "checkLogin.php";
/*the function is for getting checkbox as string
input: the answer and the number
output: the connected string
 */
function handleCheckbox($answer, $number)
{
    return implode(',', $_POST["q{$number}checkboxQuestion"]);
}

/*
the function is for sending the query to the db
input: array of answers
output: none
 */
function sendQuery($answerArr, $i)
{
    $insertString = "INSERT INTO _answers(answer, qnum, clientID, formGUID) VALUES(?,?,?,?)";
    $db = new SQLite3("database.db");
    $statement = $db->prepare($insertString);
    $statement->bindValue(1, $answerArr["answer"]);
    $statement->bindValue(2, $answerArr["qnum"]);
    $statement->bindValue(3, $_SESSION["username"]);
    $statement->bindValue(4, $answerArr["formGUID"]);
    $statement->execute();
    $db->close();
}

function checkIfAlreadyAns($guid)
{
    $selectString = "SELECT * FROM _answers WHERE clientID=? and formGUID=?";
    $db = new SQLite3("database.db");
    $statement = $db->prepare($selectString);
    $statement->bindValue(1, $_SESSION["username"]);
    $statement->bindValue(2, $guid);
    $result = $statement->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);
    $db->close();
    return $row;
}

//the main function responsible for sending all the question to the db
function main()
{
    if(checkIfAlreadyAns(explode('id=', $_SERVER['HTTP_REFERER'])[1]) <= 0)
    {
        $i = 1;
        $answerArr = array();
        do {
            if (isset($_POST["q{$i}"])) {
                $answerArr["answer"] = $_POST["q{$i}"];
            } else
            if (isset($_POST["q{$i}radioQuestion"])) {
                $answerArr["answer"] = $_POST["q{$i}radioQuestion"];
            } else
            if (isset($_POST["q{$i}checkboxQuestion"])) {
                $answerArr["answer"] = handleCheckbox($_POST["q{$i}checkboxQuestion"], $i);
            } else {
                include "AddBan.php";
                AddBan();
                echo "<script>
                alert('Are you having trouble mate? Stop messing with my code');
                alert('Your ban level has been raised!');
                window.location.href = 'menu.php';
                </script>";
            }

            $answerArr["qnum"] = $i;
            $answerArr["formGUID"] = explode('id=', $_SERVER['HTTP_REFERER'])[1];
            $stringToInsert = sendQuery($answerArr, $i);
            $i++;
        } while (isset($_POST["q{$i}"]) || isset($_POST["q{$i}radioQuestion"]) || isset($_POST["q{$i}checkboxQuestion"]));
        echo '<script> alert("Thank for submitting the form");
                    window.location.replace("menu.php");
                    </script>';
    }
    else{
        echo '<script> alert("Form already submitted contact the admin!");
                    window.location.replace("menu.php");
                    </script>';
    }
}

main();
?>

    </body>
</html>