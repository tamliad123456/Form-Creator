<?php include "checkLogin.php";
    $allowed = array("Tamir", "Ziv", "Omri");
    if (!in_array($GLOBALS['username'], $allowed))
    {
        header('Location: '."menu.php");
        exit();
    }
?>

<html>
    <head>
        <title>Admin Panel</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="bootstrap.css">
    </head>
    <body onload = "loginWithCookie();">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-7 col-md-9">
            <div class="card shadow-lg">
                <div class="card-body p-4 p-md-5">
                <center> <input type='button' style='margin:2%' value='Add new user' class='btn btn-primary btn-lg'><br>
                <h1>Users List:</h1></center>
                <?php
                $db = new SQLite3('database.db');
                $stmt = $db->prepare('SELECT uName FROM _users'); 
                $result = $stmt->execute();
                while($row = $result->fetchArray(SQLITE3_ASSOC))
                {
                    echo "<a href='editUser.php?id=".$row['uName']."'>".$row['uName']."</a><br>";
                    //TODO: add btn to ban.
                }
                ?>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>