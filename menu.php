<html id = "html">
    <head>
        <title>Menu</title>
        <script src="menu.js"></script>

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
        
        if (isset($_POST['Username']) && isset($_POST['Password']))
        {
            $username = $_POST['Username'];
            $password = hash("sha256", $_POST['Password']);
            
            $db = new SQLite3('database.db');
            $stmt = $db->prepare('SELECT uName, uPass FROM _users WHERE uName=? AND uPass=?');
            $stmt->bindValue(1, $username, SQLITE3_TEXT);
            $stmt->bindValue(2, $password, SQLITE3_TEXT);

            $result = $stmt->execute();

            $row = $result->fetchArray(SQLITE3_ASSOC);

            if($row["uName"] ==  $username && $row["uPass"] == $password)
            {
                successfullLogin($row);
            }
            else
            {
                failedLogin();
            }
        }
        else if (isset($_COOKIE['ronUName']) && isset($_COOKIE['ronPass']))
        {
            $username = $_COOKIE['ronUName'];
            $password = $_COOKIE['ronPass'];

            $db = new SQLite3('database.db');
            $stmt = $db->prepare('SELECT uName, uPass FROM _users WHERE uName=? AND uPass=?');
            $stmt->bindValue(1, $username, SQLITE3_TEXT);
            $stmt->bindValue(2, $password, SQLITE3_TEXT);

            $result = $stmt->execute();

            $row = $result->fetchArray(SQLITE3_ASSOC);

            if($row["uName"] ==  $username && $row["uPass"] == $password)
            {
                successfullLogin($row);
            }
            else
            {
                failedLogin();
            }
        }
        else
        {
            failedLogin();
        }
        

        function successfullLogin($row)
        {
            $username = $row['uName'];
            $password = $row['uPass'];

            setcookie("ronUName", $username, time() + (3 * 60 * 60));
            setcookie("ronPass", $password, time() + (3 * 60 *60));
            
            echo "<center>";
            echo "<h1 class='display-4' style='margin:10%'>The user $username has logged on successfully</h1>";
            echo "<input type='button' style='margin:2%' value='create a query' onclick='goToCreateQuery()' class='btn btn-primary btn-lg'>";
            echo "<input type='button' style='margin:2%' value='show answers for queries' onclick='goToGetAnswers()' class='btn btn-primary btn-lg'>";
            echo '</center>';
        }

        function failedLogin()
        {
            echo "<center>";
            echo "<h1 class='display-4' style='margin:10%'>username or password is incorrect</h1>";
            echo '</center>';
        }
        ?>
    </body>
</html>
