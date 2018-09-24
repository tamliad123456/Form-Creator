<?php
include "checkLogin.php";

function updatePass($pass)
{
    $db = new SQLite3('database.db');
    $statement = $db->prepare('UPDATE _users SET uPass=? where uName=? and uPass=?');
    $statement->bindValue(1, hash("sha256",$pass));
    $statement->bindValue(2, $_SESSION["username"]);
    $statement->bindValue(3, $_SESSION["password"]);
    $statement->execute();
    $db->close();
}

function main()
{
    if(isset($_POST["newPass"]))
    {
        updatePass($_POST["newPass"]);
        echo "password has updated succesfully you will have to login again";
    }
    else{
        echo "where is the new password?";
    }
}

main();

?>