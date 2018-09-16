<?php
    include "AdminCheckForLogin.php";

    $cmd = $_POST["type"];
    if($cmd == "create")
    {
        addUser();
    }
    elseif ($cmd == "delete")
    {
        deleteUser();
    }

    function deleteUser()
    {
        $uname = $_POST["uName"];

        $db = new SQLite3("../database.db");
        $deleteString = "DELETE FROM _users WHERE uName=?";
        $statement = $db->prepare($deleteString);
        $statement->bindValue(1, $uname);
        $statement->execute();
        $db->close();
        echo "$uname deleted successfuly!";
    }

    function addUser()
    {
        $uname = $_POST["uName"];
        $HashedPass = $_POST["pass"];
        if($uname != "null" && $HashedPass != "null")
        {
            echo "uname = $uname pass = $HashedPass"; 
            $db = new SQLite3("../database.db");

            $insertString = "INSERT INTO _users(uName, uPass) VALUES(?, ?)";
            $statement = $db->prepare($insertString);

            $statement->bindValue(1, "$uname");
            $statement->bindValue(2, "$HashedPass");
            $statement->execute();

            $db->close();
            echo "$uname added succesfully!";
        }
        else
        {
            echo "operation canceled";
        }
    }

?>