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
                        <center>
        <?php
include 'checkLogin.php';

echo "<h1 class='display-4' style='margin:10%'>The user " . htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8') . " has logged on successfully</h1>";
?>
<input type='button' style='margin:2%' value='Create Query' onclick='goToCreateQuery()' class='btn btn-primary btn-lg'>
<input type='button' style='margin:2%' value='Show My Queries' onclick='goToGetAnswers()' class='btn btn-primary btn-lg'>
<?php

/*
the function is for checking if you are an admin and print the button
input: none
output: none
 */
function checkIfAdmin()
{
    $allowed = array(
        "Tamir",
        "Ziv",
        "Omri",
    );
    if (in_array($_SESSION['username'], $allowed)) {
        echo "<input type='button' style='margin:2%' value='Admin Panel' onclick='goToAdminPanel()' class='btn btn-primary btn-lg'>";
    } else {
        echo "<input type='button' style='margin:2%' value='update password' onclick='updatePass()' class='btn btn-primary btn-lg'>";
    }

    ?>
	<br/><input type='button' style='margin:2%' value='Logout' onclick='LogOut()' class='btn btn-primary btn-lg'>
    </center>
    <?php
}

checkIfAdmin();
?>
    </body>
</html>

