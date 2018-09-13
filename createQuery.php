<?php include 'checkLogin.php'; ?>
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
            echo file_get_contents("createQuery.htm");
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