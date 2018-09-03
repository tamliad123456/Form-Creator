<html>
    <head>
        <title>Answer a querry</title>
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
                        <form action="submitQuery.php" method="POST">
                            <?php
                                $guid = $_GET["id"];
                                $number = 1;

                                if($guid == "1a2b3c")
                                {
                                    addQuestionString("Hello");
                                    addQuestion($number);
                                    $number++;
                                    addQuestionString("My");
                                    addRadio($number, 3, array("option1", "option2", "option3"));
                                    $number++;
                                    addQuestionString("Friend");
                                    addCheckBox($number, 3, array("option1", "option2", "option3"));
                                    addSubmitButton();
                                }

                                function addQuestion($number)
                                {
                                    echo "<input type='text' class='form-control' name='q$number' placeholder='answer' style='margin-left:2%; margin-right:2%; margin-top:2%'>";
                                    echo "<br>";
                                }

                                function addQuestionString($question)
                                {
                                    echo "<h4 class='display-5' style='margin:2%'>$question</h4>";
                                }

                                function addRadio($number, $optionNumber, $arrayOfOptions)
                                {
                                    for($i = 1; $i <= $optionNumber; $i++)
                                    {
                                        echo "<div class='input-group input-group-lg pb-2' style='flex-wrap:nowrap'>";
                                        echo "<input type='Radio' class='form-control' placeholder='answer' id='r$number,$i' name='radioQestion' width='50px' height='50px'";
                                        echo "style='margin-left:2%; margin-right:2%; width:3%; height:5%'>";
                                        $index = $i - 1;
                                        echo "<lable for='r$number,$i' style='width: 97%; line-height: 175%'>$arrayOfOptions[$index]</lable>";
                                        echo "</div>";
                                    }
                                }

                                function addCheckBox($number, $optionNumber, $arrayOfOptions)
                                {
                                    for($i = 1; $i <= $optionNumber; $i++)
                                    {
                                        echo "<div class='input-group input-group-lg pb-2' style='flex-wrap:nowrap'>";
                                        echo "<input type='checkbox' class='form-control' placeholder='answer' id='c$number,$i' name='radioQestion' width='50px' height='50px'";
                                        echo "style='margin-left:2%; margin-right:2%; width:3%; height:5%'>";
                                        $index = $i - 1;
                                        echo "<lable for='c$number,$i' style='width: 97%; line-height: 175%'>$arrayOfOptions[$index]</lable>";
                                        echo "</div>";
                                    }
                                }

                                function addSubmitButton()
                                {
                                    echo '<center> <input type="submit" style="margin:2%" value="Submit Answers" class="btn btn-primary btn-lg"> </center';

                                }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>