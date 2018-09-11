<html id = "html">
    <head>
        <title>Menu</title>
        <script src="createQuery.js"></script>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="bootstrap.css">
    </head>

    <body id = "TheBody">
        <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-7 col-md-9">
                    <div class="card shadow-lg">
                        <div class="card-body p-4 p-md-5">

<?php

        $db = new SQLite3("database.db");

        $guidsArr = getUserForms($db);

        $guidsArr = explode("&&", $guidsArr);

        for($i = 0; $i < count($guidsArr); $i++)
        {
            echo "<a href='answerQuery.php?id=$guidsArr[$i]'>Form $i </a>";
        }

        function getUserForms($db)
        {
            $username = $_COOKIE["ronUName"];
            $password = $_COOKIE["ronPass"];
            
            $getQuery = "SELECT guid FROM _users WHERE uName=? AND uPass=?";
            $statement = $db->prepare($getQuery);

            $statement->bindValue(1, $username);
            $statement->bindValue(2, $password);
            $result = $statement->execute();

            $row = $result->fetchArray(SQLITE3_ASSOC);
            if(isset($row["guid"]))
            {
                return $row["guid"];
            }
            else
            {
                return "";
            }

        }
?>