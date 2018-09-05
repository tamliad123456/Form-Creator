<html id = "html">
    <head>
        <title>create a querry</title>
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
        
        $username = $_POST['Username'];
        $password = $_POST['Password'];

        $db = new SQLite3('database.db');
        $stmt = $db->prepare('SELECT uName, uPass FROM _users WHERE uName=:uname AND uPass=:upass');
        $stmt->bindValue(':uname', $username, SQLITE3_TEXT);
        $stmt->bindValue(':upass', $password, SQLITE3_TEXT);
        $result = $stmt->execute();
        $row = $result->fetchArray();
        error_reporting(E_ERROR | E_PARSE);

        $username = "";
        $password = "";
        if(count($row) > 1)
        {
            $username = $row[0];
            $password = $row[1];

            setcookie("ronUName", $username, time() + (3 * 60 * 60));
            setcookie("ronPass", hash("sha256", $password), time() + (3 * 60 *60));
            
            echo "<center>";
            echo "<h1 class='display-4' style='margin:10%'>The user $username has logged on successfully</h1>";
            echo "<input type='button' style='margin:2%' value='create a query' onclick='post()' class='btn btn-primary btn-lg'>";
            echo "<input type='button' style='margin:2%' value='show answers for queries' class='btn btn-primary btn-lg'>";
            echo '</center>';
        }
        else
        {
            echo "<center>";
            echo "<h1 class='display-4' style='margin:10%'>username or password is incorrect</h1>";
            echo '</center>';
        }
        ?>
    </body>
</html>