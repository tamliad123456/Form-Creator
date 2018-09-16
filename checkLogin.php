<?php
if (isset($_POST['Username']) && isset($_POST['Password']))
        {
            $username = $_POST['Username'];
            if(!isset($_POST['alreadyHashed']))
            {
                $password = hash("sha256", $_POST['Password']);
            }
            else
            {
                $password = $_POST['Password'];
            }

            $db = new SQLite3('database.db');
            $stmt = $db->prepare('SELECT uName, uPass FROM _users WHERE uName=? AND uPass=?');
            $stmt->bindValue(1, $username, SQLITE3_TEXT);
            $stmt->bindValue(2, $password, SQLITE3_TEXT);

            $result = $stmt->execute();

            $row = $result->fetchArray(SQLITE3_ASSOC);

            if($row["uName"] ==  $username && $row["uPass"] == $password)
            {
                $username = $row['uName'];
                $password = $row['uPass'];
        
                setcookie("ronUName", $username, time() + (5));
                setcookie("ronPass", $password, time() + (5));
            }
            else
            {
                failedLogin("login");
            }
            $db->close();
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
                $username = $row['uName'];
                $password = $row['uPass'];
        
                setcookie("ronUName", $username, time() + (60 * 60));
                setcookie("ronPass", $password, time() + (60 * 60));

            }
            else
            {
                failedLogin("cookie");
            }
            $db->close();
        }
        else
        {
            failedLogin();
        }
        

        function failedLogin($var = "hello")
        {
            if($var == "cookie")
            {
                header('Location: '."index.htm");
            }
            else if($var == "login")
            {
                echo "<center>";
                echo "<h1 class='display-4' style='margin:10%'>username or password is incorrect</h1>";
                echo "<input type='button' style='margin:2%' value='return to login' onclick='removeCookie()' class='btn btn-primary btn-lg'>";
                echo '</center>';
            }
            else{
                header('Location: '."index.htm");
            }
            exit();
        }

?>