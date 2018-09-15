<?php include 'checkLogin.php';?>
<html id = "html">
    <head>
                <title>create a query</title>
                <script src="addQuestions.js"></script>

                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <link rel="stylesheet" href="bootstrap.css">
        </head>
<body>
<form action="submitQuery.php" method="POST">
    <div id = "TheBody">

    <?php
        $username = "";
        $password = "";
        
        if(isset($_COOKIE["ronUName"]) && isset($_COOKIE["ronPass"]))
        {
            $username = $_COOKIE["ronUName"];
            $password = $_COOKIE["ronPass"];
        }

        else
        {
            echo '<script> window.location.href = "index.htm"; </script>';
        }

        if(($username != "" && $password != ""))
        {
            echo '<div class="row justify-content-center">';
            include "back.php";
            echo '<div class="col-xl-6 col-lg-7 col-md-9" style="margin-right:8%">
                <div class="card shadow-lg">
                    <div class="card-body p-4 p-md-5" >
                        <center>
                            <h1>welcome to form creation</h1>
                            <br>
                            <input type="button" onclick="addQuestion()" style="margin:2%" value="Add Question" class="btn btn-primary btn-lg">
                            <input type="button" onclick="addRadioOrCheckBox("radio")" style="margin:2%" value="Add Radio"
                                class="btn btn-primary btn-lg">
                            <input type="button" onclick="addRadioOrCheckBox("checkbox")" style="margin:2%" value="Add CheckBox"
                                class="btn btn-primary btn-lg">
        
                        </center>
                        <center>
                            <input type="submit" style="margin:2%" value="Submit Questions" class="btn btn-primary btn-lg">
                        </center>
                    </div>
                </div>
            </div>
        </div>';
        }

        else
        {
            echo '<script> window.location.href = "index.htm"; </script>';
        }

    ?>
    </div>
    </form>


</body>
</html>