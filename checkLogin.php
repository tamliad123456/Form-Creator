<?php
session_start();

/*
the function is for checking login with post
input: none
output: none
 */
function checkWithPost()
{
    $username = $_POST['Username'];
    if (!isset($_POST['alreadyHashed'])) {
        $password = hash("sha256", $_POST['Password']);
    } else {
        $password = $_POST['Password'];
    }

    $db = new SQLite3('database.db');
    $stmt = $db->prepare('SELECT uName, uPass, ban FROM _users WHERE uName=? AND uPass=?');
    $stmt->bindValue(1, $username, SQLITE3_TEXT);
    $stmt->bindValue(2, $password, SQLITE3_TEXT);
    $result = $stmt->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);

    if ($row && $row["ban"] < 3) {
        $_SESSION["username"] = $row['uName'];
        $_SESSION["password"] = $row['uPass'];
        $_SESSION["ban"] = $row['ban'];
        $_SESSION["connected"] = "1";
        header("Location: menu.php");
    } else {
        failedLogin();
    }

    $db->close();
}

/*
the function is for checking login with Cookie and Session
input: none
output: none
 */
function checkWithSession()
{
    if (isset($_SESSION["username"], $_SESSION["password"], $_SESSION["ban"]) && $_SESSION["ban"] < 3) {
    } else {
        failedLogin("cookie");
    }
}

/*
the function is for letting the user know he is'nt connected
input: if cookie or login
output: none
 */
function failedLogin()
{
    echo "<center>";
    echo "<h1 class='display-4' style='margin:10%'>username or password is incorrect or you have a ban contact the admin</h1>";
    echo "<input type='button' style='margin:2%' value='return to login' onclick='LogOut()' class='btn btn-primary btn-lg'>";
    echo '</center>';

    die();
}

function checkAdmin()
{
    $allowed = array(
        "Tamir",
        "Ziv",
        "Omri",
    );
    
    if (!in_array($_SESSION['username'], $allowed)) {
        header('Location: ' . "menu.php");
        die();
    }
}

if (isset($_POST['Username'], $_POST['Password'])) {
    checkWithPost();
} else
if (isset($_SESSION["connected"])) {
    checkWithSession();
}
else
{
    failedLogin();
}
