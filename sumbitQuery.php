<html>
    <head>
                <title>create a querry</title>
                <script src="addQuestions.js"></script>

                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <link rel="stylesheet" href="bootstrap.css">
        </head>
<body id = "TheBody">
    <?php
        $check = true;
        $i = 1;
        SQLite3::open("database.db");

        do
        {
            if(isset($_POST["q" + $i.toString()]))
            {
                $queryQuestion = $_POST["q" + $i.toString()];
                $queryData = ;
            }
        } while(check);
    ?>

</body>
</html>