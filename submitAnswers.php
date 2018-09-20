<html>
    <head>
        <title>Answer</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="bootstrap.css">
    </head>
    <body>
        <?php
            $i = 1;
        
            $answerArr = array();
            $clientGUID = uniqid();
            do
            {
               if(isset($_POST["q{$i}"]))
               {
                   $answerArr["answer"] = $_POST["q{$i}"];
               }
               else if(isset($_POST["q{$i}radioQuestion"]))
               {
                   $answerArr["answer"] = $_POST["q{$i}radioQuestion"];
               }
               else if(isset($_POST["q{$i}checkboxQuestion"]))
               {
                   $answerArr["answer"] = handleCheckbox($_POST["q{$i}checkboxQuestion"], $i);
               }
               else
               {
                   #PLACEHOLDER for banning
               }
               $answerArr["qnum"] = $i;
               $answerArr["clientID"] = $clientGUID;
               $answerArr["formGUID"] = explode('id=', $_SERVER['HTTP_REFERER'])[1];
               $stringToInsert = sendQuery($answerArr, $i);
               $i++;

            } while (isset($_POST["q{$i}"]) || isset($_POST["q{$i}radioQuestion"]) || isset($_POST["q{$i}checkboxQuestion"]));

            function handleCheckbox($answer, $number)
            {
                return implode(',', $_POST["q{$number}checkboxQuestion"]);
            }
            
            function sendQuery($answerArr, $i)
            {            
                $insertString = "INSERT INTO _answers(answer, qnum, clientID, formGUID) VALUES(?,?,?,?)";

                $db = new SQLite3("database.db");
                $statement = $db->prepare($insertString);
                $statement->bindValue(1, $answerArr["answer"]);
                $statement->bindValue(2, $answerArr["qnum"]);
                $statement->bindValue(3, $answerArr["clientID"]);
                $statement->bindValue(4, $answerArr["formGUID"]);
    
                $statement->execute();
                $db->close();
            }
            
        echo '<script> alert("Thank for submitting the form");
        window.location.replace("menu.php");
        </script>';

        ?>

    </body>
</html>