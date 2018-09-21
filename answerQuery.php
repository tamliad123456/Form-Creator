<html>
    <head>
        <title>Answer a query</title>
        <script src="addQuestions.js"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="bootstrap.css">
    </head>
    <body id = "TheBody">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-7 col-md-9">
                <div class="card shadow-lg">
                    <div class="card-body p-4 p-md-5">
                        <center>
                            <h1 class="display-4" style="margin:10%">Please answer the Question</h1>
                        </center>
                        <form action="submitAnswers.php" method="POST">
<?php include "checkLogin.php";
    
    //the function is returning a question with type of input
    function addQuestion($number)
    {
        echo "\t\t\t\t\t\t<input type='text' class='form-control' name='q$number' placeholder='answer' style='margin-left:2%; margin-right:2%; margin-top:2%'>\n";
        echo "\t\t\t\t\t\t<br>\n";
    }

    //the function returns const of the question string
    function addQuestionString($question)
    {
        echo "\t\t\t\t\t\t<h4 class='display-5' style='margin:2%'>";
        echo htmlspecialchars($question, ENT_QUOTES, 'UTF-8');
        echo "</h4>\n";
    }
    
    //the function is returning the parameters as an array
    function parseOptions($params)
    {
        return explode("&&", $params);
    }

    //the function is adding a radio type of question
    function addRadio($number, $optionNumber, $arrayOfOptions)
    {
        for($i = 1; $i <= $optionNumber; $i++)
        {
            echo "\t\t\t\t\t\t<div class='input-group input-group-lg pb-2' style='flex-wrap:nowrap'>\n";
            $index = $i - 1;
            if($i == 1)
            {
                echo "\t\t\t\t\t\t<input type='Radio' class='form-control' placeholder='answer' value='".htmlspecialchars($arrayOfOptions[$index], ENT_QUOTES, 'UTF-8')."' id='r$number,$i' name='q$number"."radioQuestion' width='50px' height='50px' checked";
            }
            else
            {
                echo "\t\t\t\t\t\t<input type='Radio' class='form-control' placeholder='answer' value='".htmlspecialchars($arrayOfOptions[$index], ENT_QUOTES, 'UTF-8')."' id='r$number,$i' name='q$number"."radioQuestion' width='50px' height='50px'";
            }
            echo "\t\t\t\t\t\tstyle='margin-left:2%; margin-right:2%; width:3%; height:5%'>\n";
            echo "\t\t\t\t\t\t<h5 for='r$number,$i' style='width: 97%; line-height: 175%'>\n\t\t\t\t\t\t";
            echo htmlspecialchars($arrayOfOptions[$index], ENT_QUOTES, 'UTF-8');
            echo "\t\t\t\t\t\t</h5>\n";
            echo "\t\t\t\t\t\t</div>\n";
        }
    }

    //the function is adding a checkbox type of question
    function addCheckBox($number, $optionNumber, $arrayOfOptions)
    {
        for($i = 1; $i <= $optionNumber; $i++)
        {
            echo "\t\t\t\t\t\t<div class='input-group input-group-lg pb-2' style='flex-wrap:nowrap'>\n";
            $index = $i - 1;
            if($i == 1)
            {
                echo "\t\t\t\t\t\t<input type='checkbox' class='form-control' placeholder='answer' value='".htmlspecialchars($arrayOfOptions[$index], ENT_QUOTES, 'UTF-8')."' id='c$number,$i' name='q$number"."checkboxQuestion[]' width='50px' checked height='50px'\n";
            }
            else
            {
                echo "\t\t\t\t\t\t<input type='checkbox' class='form-control' placeholder='answer' value='".htmlspecialchars($arrayOfOptions[$index], ENT_QUOTES, 'UTF-8')."' id='c$number,$i' name='q$number"."checkboxQuestion[]' width='50px' height='50px'\n";
            }
            echo "\t\t\t\t\t\tstyle='margin-left:2%; margin-right:2%; width:3%; height:5%'>\n";
            echo "\t\t\t\t\t\t<h5 for='c$number,$i' style='width: 97%; line-height: 175%'>\n\t\t\t\t\t\t";
            echo htmlspecialchars($arrayOfOptions[$index], ENT_QUOTES, 'UTF-8');
            echo "\t\t\t\t\t\t</h5>\n";
            echo "\t\t\t\t\t\t</div>\n";
        }
    }

    //the function is adding a submit button to the form
    function addSubmitButton()
    {
        echo "\t\t\t\t\t\t<center> <input type=\"submit\" style=\"margin:2%\" value=\"Submit Answers\" class=\"btn btn-primary btn-lg\"> </center>\n";
    }

    //the main function
    function main()
    {
        $guid = $_GET["id"];

        $db = new SQLite3('database.db');
        $statement = $db->prepare('SELECT * FROM _queries WHERE formGUID = ?');
        $statement->bindValue(1, $guid);
        $result = $statement->execute();
        $flag = false;
        while(($row = $result->fetchArray(SQLITE3_ASSOC))) 
        {
            $flag = true;
            $parameters = parseOptions($row['parms']);
            addQuestionString($row['question']);
            if($row['type'] == "input")
            {
                addQuestion($row['qNum']);
            }
            else if($row['type'] == "radio")
            {
                addRadio($row['qNum'], count($parameters), $parameters);
            }
            else if($row['type'] == "checkbox")
            {
                addCheckBox($row['qNum'], count($parameters), $parameters);
            }
        }

        if(!$flag)
        {
            echo "<script>alert('Are you having trouble mate? Stop messing with my code');
            document.getElementById('TheBody').innerHTML = '<center><h1>Stop messing with my code</h1></center>';
            </script>";
        }
        addSubmitButton();
        $result->finalize();
        $db->close();
    }

    main();

?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>