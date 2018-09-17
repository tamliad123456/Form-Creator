<?php
include "checkLogin.php";
checkIfAllowed();

function checkIfAllowed()
{   
    $db = new SQLite3("database.db");
    
    $insertString = "SELECT guid FROM _users where uName=? AND uPass=?";
    $statement = $db->prepare($insertString);
    $statement->bindValue(1, $GLOBALS["username"]);
    $statement->bindValue(2, $GLOBALS["password"]);
    $result = $statement->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC)["guid"];
    $guidsArr = explode("&&", $row);
        
    $allowed = array("Tamir", "Ziv", "Omri");
    if (!in_array($GLOBALS['username'], $allowed) && !in_array($_GET["guid"], $guidsArr))
    {
        header('Location: '."menu.php");
        exit();
    }

}
?>

<html>
    <head>
        <title>create a query</title>

            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link rel="stylesheet" href="bootstrap.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
    </head> 
<body id = "TheBody">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-7 col-md-9">
            <div class="card shadow-lg">
                <div class="card-body p-4 p-md-5">
                    <h3>Link to answer the form:</h3>
                    <input type="text" class="form-control" disabled value="
<?php
                    echo "IP/answerQuery.php?id=".$_GET['guid'];
                    ?>">
                    <center>
                        <h3>Here is the Statistics for the selected form:</h3><br>
                    </center>
                    <?php

                    function main()
                    {
                        for($number = 1; $number <= getNumOfQuestion(); $number++)
                        {
                            $arr = getDataArr();
                            if($arr[$number - 1]["type"] == "checkbox" || $arr[$number - 1]["type"] == "radio")
                            {
                                echo '<center><h3>'.$arr[$number - 1]["question"].'</h3></center>';
                                $arr = getValues($number, $arr);
                                echoQuestionArr(countAnswers($arr), $number);
                            }
                            else
                            {
                                echo '<center><h3>'.$arr[$number - 1]["question"].'</h3></center>';
                                addTable($number, $arr);
                            }
                        }
                    }

                    function getNumOfQuestion()
                    {
                        return count(getDataArr());
                    }

                    function getDataArr()
                    {
                        $arr = array();
                        $i = 0;
                        $db = new SQLite3("database.db");
                        $selectString = "SELECT * FROM _queries WHERE formGUID=?";
                        $statement = $db->prepare($selectString);
                        $statement->bindValue(1, $_GET["guid"]);
                        $result = $statement->execute();
                        while($row = $result->fetchArray(SQLITE3_ASSOC))
                        {
                            $arr[$i] = $row;
                            $i++;
                        }

                        $db->close();
                        return $arr;
                    }

                    function getValues($number, $questionArr)
                    {
                        $arr = array();
                        $i = 0;
                        $db = new SQLite3("database.db");
                        $selectString = "SELECT * FROM _answers3 WHERE formGUID=? AND qNum=?";
                        $statement = $db->prepare($selectString);
                        $statement->bindValue(1, $_GET["guid"]);
                        $statement->bindValue(2, $number);
                        $result = $statement->execute();
                        while($row = $result->fetchArray(SQLITE3_ASSOC))
                        {
                            $arr[$i] = $row;
                            $i++;
                        }

                        $db->close();
                        return $arr;
                    }

                    function countAnswers($valuesArr)
                    {
                        $arr = array();
                        for($i = 0; $i < count($valuesArr); $i++)
                        {
                            $ans = explode(",", $valuesArr[$i]["answer"]);
                            for($j = 0; $j < count($ans); $j++)
                            {
                                if(isset($arr[$ans[$j]]))
                                {
                                    $arr[$ans[$j]]++;
                                }
                                else{
                                    $arr[$ans[$j]] = 1;
                                }
                            }
                        }
                        return $arr;
                    }

                    function addTable($number, $arr)
                    {
                        echo "<table border=1>";
                        $valueArr = getValues($number, $arr);
                        
                        for($i = 0; $i < count($valueArr); $i++)
                        {
                            echo "<tr>";
                            echo "<td> <h3>". htmlspecialchars($valueArr[$i]["answer"], ENT_QUOTES, 'UTF-8')."</h3></td>";
                            echo "</tr>";
                        }
                        
                    }
                    function echoQuestionArr($arr, $id)
                    {
                        echo "<center>";
                        echo '<canvas id="myChart'.$id.'" width="500" height="500"></canvas>';
                        echo '<script>
                        var ctx = document.getElementById("myChart'.$id.'").getContext("2d");
                        var myChart = new Chart(ctx, {
                            type: "pie",
                            data: {
                                labels:';
                                echo ' [';
                                foreach ($arr as $key => $value)
                                {
                                    echo '"'.$key.'",';
                                }
                        echo '],
                        datasets: [{
                            label: [';
                            foreach ($arr as $key => $value)
                            {
                                echo '"'.$key.'",';
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
                    
                    main();
?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>