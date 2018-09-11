<html>
    <head>
                <title>create a query</title>

                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <link rel="stylesheet" href="bootstrap.css">
        </head>
<body id = "TheBody">
    <?php
        $i = 1;
        
        $questionArr = array();

        do
        {
            if(isset($_POST["q{$i}input"]))
            {
                $questionArr["question"] = $_POST["q{$i}input"];
                $questionArr["type"] = "input";
                $questionArr["params"] = "";
            }
            else if(isset($_POST["q{$i}radio"]))
            {
                $questionArr["question"] = $_POST["q{$i}radio"];
                $questionArr["type"] = "radio";
                $questionArr["params"] = parseParams("q$i");
            }
            else if(isset($_POST["q{$i}checkbox"]))
            {
                $questionArr["question"] = $_POST["q{$i}checkbox"];
                $questionArr["type"] = "checkbox";
                $questionArr["params"] = parseParams("q$i");
            }
            else
            {
                #PLACEHOLDER for banning
            }

            $questionArr["GUID"] = uniqid();
            $questionArr["qNum"] = $i;
            $i++;
            $stringToInsert = sendQuery($questionArr, $i);
        } while (isset($_POST["q{$i}input"]) || isset($_POST["q{$i}checkbox"]) || isset($_POST["q{$i}radio"]));


        function parseParams($number)
        {
            $i = 2;
            $string = $_POST["{$number}&&option1"];
            do
            {
                $string = "{$string}&&";
                $string =  $string. $_POST[$number."&&option$i"];
                $i++;
            }while(isset($_POST["{$number}&&option{$i}"]));
            return $string;
        }

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
    ?>

</body>
</html>