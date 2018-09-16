<?php
    if (isset($_COOKIE['ronUName']) && isset($_COOKIE['ronPass']))
    {
        $username = $_COOKIE['ronUName'];
        $password = $_COOKIE['ronPass'];
        $db = new SQLite3('..//database.db');
        $stmt = $db->prepare('SELECT uName, uPass FROM _users WHERE uName=? AND uPass=?');
        $stmt->bindValue(1, $username, SQLITE3_TEXT);
        $stmt->bindValue(2, $password, SQLITE3_TEXT);
        $result = $stmt->execute();
        $row = $result->fetchArray(SQLITE3_ASSOC);
        if($row["uName"] ==  $username && $row["uPass"] == $password)
        {
            $username = $row['uName'];
            $password = $row['uPass'];
    
            setcookie("ronUName", $username, time() + (60 * 60));
            setcookie("ronPass", $password, time() + (60 * 60));
        }
        else
        {
            failedLogin();
        }
        $db->close();
    }
    else
    {
        failedLogin();
    }
    
    function failedLogin()
    {
        header('Location: '."../index.htm");
        exit();
    }

?>