<?php
    include "checkLogin.php";

    $cmd = $_POST["type"];
    if($cmd == "create")
    {
        addUser();
    }
    else if ($cmd == "delete")
    {
        deleteUser();
    }
    else if ($cmd == "update")
    {
        changePassword();
    }
    else if($cmd == "seeForms")
    {
        getForms();
    }
    else if($cmd == "ban")
    {
        addBan();
    }

    function deleteUser()
    {
        $pass = $_POST["pass"];
        $pass = hash("sha256", $pass);
        
        $db = new SQLite3("database.db");
        $selectString = "SELECT uName, uPass FROM _users WHERE uName=? AND uPass=?";
        $statement = $db->prepare($selectString);
        $statement->bindValue(1, $_SESSION['username']);
        $statement->bindValue(2, $pass);
        
        $result = $statement->execute();
        $row = $result->fetchArray(SQLITE3_ASSOC);
        
        if($row['uName'] == $_SESSION['username'] && $row['uPass'] == $pass)
        {
            $uname = $_POST["uName"];
            $deleteString = "DELETE FROM _users WHERE uName=?";
            $statement = $db->prepare($deleteString);
            $statement->bindValue(1, $uname);
            $statement->execute();
            echo "$uname deleted successfuly!";
        }
        else
        {
            echo "Operation failed.";
        }
        $db->close();
    }

    function addUser()
    {
        $uname = $_POST["uName"];
        $HashedPass = $_POST["pass"];
        if($uname != "null" && $HashedPass != "null")
        {
            $db = new SQLite3("database.db");

            $insertString = "INSERT INTO _users(uName, uPass, ban) VALUES(?, ?, 0)";
            $statement = $db->prepare($insertString);

            $statement->bindValue(1, "$uname");
            $statement->bindValue(2, "$HashedPass");
            $statement->execute();

            $db->close();
            echo "$uname added succesfully!";
        }
        else
        {
            echo "operation canceled.";
        }
    }


    function changePassword()
    {
        $uname = $_POST["uName"];
        $HashedPass = $_POST["pass"];
        if($uname != "null" && $HashedPass != "null")
        {
            $db = new SQLite3("database.db");

            $insertString = "UPDATE _users SET uPass=? WHERE uName=?";
            $statement = $db->prepare($insertString);

            $statement->bindValue(1, "$HashedPass");
            $statement->bindValue(2, "$uname");
            $statement->execute();

            $db->close();
            echo "Password Updated succesfully!";
        }
        else
        {
            echo "operation canceled.";
        }
    }

    function getForms()
    {
        $uname = $_POST['uName'];

        $db = new SQLite3("database.db");
        $selectString = "SELECT guid FROM _users WHERE uName=?";
        $statement = $db->prepare($selectString);
        $statement->bindValue(1, $uname);
        $result = $statement->execute();
        $row = $result->fetchArray(SQLITE3_ASSOC)["guid"];
        $guidsArr = explode("&&", $row);
        for($i = 0; $i < count($guidsArr) && $guidsArr[0] != ""; $i++)
        {  
            echo "<a href='showStats.php?guid=".htmlspecialchars($guidsArr[$i], ENT_QUOTES, 'UTF-8')."'>Form $i </a>";
            echo "<br>";
        }
    }

    function addBan()
    {
        $uname = $_POST['uName'];
        $banLvl = $_POST["ban"];
        $db = new SQLite3("database.db");

        $updateString = "UPDATE _users SET ban=? WHERE uName=?";
        $statement = $db->prepare($updateString);
        $statement->bindValue(1, $banLvl);
        $statement->bindValue(2, $uname);
        $statement->execute();
        $db->close();
        echo "Ban Updated Successfully";
    }
?>