
<?php
include "checkLogin.php";

function getBanNumber()
{
    $db = new SQLite3('database.db');
    $statement = $db->prepare('SELECT ban from _users where uName=? and uPass=?');
    $statement->bindValue(1, $_SESSION["username"]);
    $statement->bindValue(2, $_SESSION["password"]);
    $result = $statement->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);
    $db->close();
    return $row["ban"];
}

function updateBan($banLvl)
{
    $db = new SQLite3('database.db');
    $statement = $db->prepare('UPDATE _users SET ban=? where uName=? and uPass=?');
    $statement->bindValue(1, $banLvl);
    $statement->bindValue(2, $_SESSION["username"]);
    $statement->bindValue(3, $_SESSION["password"]);
    $statement->execute();
    $db->close();
}

function main()
{
    if(isset($_POST["pass"]) && isset($_SESSION["password"]) && $_POST["pass"] == $_SESSION["password"])
    {
        $banLvl = getBanNumber();
        $banLvl++;
        updateBan($banLvl);
        echo "You'r ban level has been raised!";
    }
    else
    {
        echo $_POST["pass"];
    }
}

main();
?>