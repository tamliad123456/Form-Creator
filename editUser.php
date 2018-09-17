<?php
include "checkLogin.php";
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
        <script src="menu.js"></script>
        <script src="Admin.js"></script>


    </head>
    <body onload = "loginWithCookie('Admin');">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-7 col-md-9">
            <div class="card shadow-lg">
                <div class="card-body p-4 p-md-5">
                <center>
                <?php
                echo "<h1>Edit The User ".htmlspecialchars($_GET["id"], ENT_QUOTES, 'UTF-8').":</h1></center>";
                echo "</center>";
                ?>
                <center>
                <?php
                    echo "<input type='button' class='btn btn-primary btn-lg' value='Change Password' onclick='updatePassword(\"".htmlspecialchars($_GET["id"], ENT_QUOTES, 'UTF-8')."\")'>";
                    echo "<input type='button' class='btn btn-primary btn-lg' value='Delete User'onclick='deleteUser(\"".htmlspecialchars($_GET["id"], ENT_QUOTES, 'UTF-8')."\")'>";
                    echo "<input type='button' class='btn btn-primary btn-lg' value='See Forms' onclick='seeForms(\"".htmlspecialchars($_GET["id"], ENT_QUOTES, 'UTF-8')."\")'>";
                    echo "<input type='button' class='btn btn-primary btn-lg' value='Ban' onclick='updateBan(\"".htmlspecialchars($_GET["id"], ENT_QUOTES, 'UTF-8')."\")'>";
                ?>
                </center>   
                <div id="lastDiv">
                </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
