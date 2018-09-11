<html id = "html">
    <head>
                <title>create a query</title>
                <script src="addQuestions.js"></script>

                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <link rel="stylesheet" href="bootstrap.css">
        </head>
<body>
<form action="sumbitQuery.php" menthod="post">
    <div id = "TheBody">
    <?php
        $username = "";
        $password = "";
        
        if(isset($_COOKIE["ronUName"]))
        {
            $username = $_COOKIE["ronUName"];
        }
        
        if(isset($_COOKIE["ronPass"]))
        {
            $password = $_COOKIE["ronPass"];
        }

        if(($username != "" && $password != ""))
        {
            echo file_get_contents("createQuery.htm");
        }

        else
        {
            echo "There is no such user";
        }

    ?>
    </div>
    </form>


</body>
</html>