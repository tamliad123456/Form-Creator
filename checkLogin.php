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
    if ($row["uName"] == $username && $row["uPass"] == $password && $row["ban"] < 3) {
        $_SESSION["username"] = $row['uName'];
        $_SESSION["password"] = $row['uPass'];
        setcookie("connected", hash("sha256", $row['uName'] . $row['uPass']));
        header("Location: menu.php");
    } else {
        failedLogin("login");
    }

    $db->close();
}

/*
the function is for checking login with Cookie and Session
input: none
output: none
 */
function checkWithCookie()
{
    if (isset($_SESSION["username"]) && isset($_SESSION["password"])) {
        $db = new SQLite3('database.db');
        $stmt = $db->prepare('SELECT uName, uPass, ban FROM _users WHERE uName=? AND uPass=?');
        $stmt->bindValue(1, $_SESSION["username"], SQLITE3_TEXT);
        $stmt->bindValue(2, $_SESSION["password"], SQLITE3_TEXT);
        $result = $stmt->execute();
        $row = $result->fetchArray(SQLITE3_ASSOC);
        if ($row["uName"] == $_SESSION["username"] && $_SESSION["password"] == $row["uPass"] && $row["ban"] < 3) {
            setcookie("connected", hash("sha256", $row['uName'] . $row['uPass']));
        } else {
            if($row["ban"] < 3)
            {
                failedLogin("cookie");
            }
            else{
                failedLogin("login");
            }
        }

        $db->close();
    } else {
        failedLogin("cookie");
    }
}

/*
the function is for letting the user know he is'nt connected
input: if cookie or login
output: none
 */
function failedLogin($var)
{
    if ($var == "cookie") {
        header('Location: ' . "index.htm");
    } else
    if ($var == "login") {
        echo "<center>";
        echo "<h1 class='display-4' style='margin:10%'>username or password is incorrect or you have a ban contact the admin</h1>";
        echo "<input type='button' style='margin:2%' value='return to login' onclick='removeCookie()' class='btn btn-primary btn-lg'>";
        echo '</center>';
    } else {
        header('Location: ' . "index.htm");
    }

    die();
}

if (isset($_POST['Username']) && isset($_POST['Password'])) {
    checkWithPost();
} else
if (isset($_COOKIE['connected'])) {
    checkWithCookie();
}
else
{
    failedLogin("login");
}
