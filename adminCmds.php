<?php
include "checkLogin.php";
checkAdmin();

/*
the function is for deleting a user from the system
input: none
output: none
 */
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

    if ($row['uName'] === $_SESSION['username'] && $row['uPass'] === $pass) {
        $uname = $_POST["uName"];
        $deleteString = "DELETE FROM _users WHERE uName=?";
        $statement = $db->prepare($deleteString);
        $statement->bindValue(1, $uname);
        $statement->execute();
        echo "$uname deleted successfuly!";
    } else {
        echo "Operation Canceled.";
    }
    $db->close();
}

/*
the function is for adding a new user to the db
input: none
output: none
 */
function addUser()
{
    $uname = $_POST["uName"];
    $HashedPass = $_POST["pass"];
    if ($uname != "null" && $HashedPass != "null") {
        $db = new SQLite3("database.db");

        $insertString = "INSERT INTO _users(uName, uPass, ban) VALUES(?, ?, 0)";
        $statement = $db->prepare($insertString);

        $statement->bindValue(1, "$uname");
        $statement->bindValue(2, "$HashedPass");
        $statement->execute();

        $db->close();
        echo "$uname added succesfully!";
    } else {
        echo "Operation Canceled.";
    }
}

/*
the function is for changing the password
input: none
output: none
 */
function changePassword()
{
    $uname = $_POST["uName"];
    $HashedPass = $_POST["pass"];
    if ($uname != "null" && $HashedPass != "null") {
        $db = new SQLite3("database.db");

        $insertString = "UPDATE _users SET uPass=? WHERE uName=?";
        $statement = $db->prepare($insertString);

        $statement->bindValue(1, "$HashedPass");
        $statement->bindValue(2, "$uname");
        $statement->execute();

        $db->close();
        echo "Password Updated succesfully!";
    } else {
        echo "Operation Canceled.";
    }
}

/*
the function is for getting a form from the db
input: none
output: none
 */
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
    $len = count($guidsArr);
    for ($i = 0; $i < $len && $guidsArr[0] != ""; $i++) {
        echo "<a href='showStats.php?guid=" . htmlspecialchars($guidsArr[$i], ENT_QUOTES, 'UTF-8') . "'>Form $i </a>";
        echo "<br>";
    }
}

/*
the function is for updating a ban
input: none
output: none
 */
function updateBan()
{
    $uname = $_POST['uName'];
    $banLvl = $_POST["ban"];
    if ($banLvl != "null" && $banLvl != "") {
        $db = new SQLite3("database.db");

        $updateString = "UPDATE _users SET ban=? WHERE uName=?";
        $statement = $db->prepare($updateString);
        $statement->bindValue(1, $banLvl);
        $statement->bindValue(2, $uname);
        $statement->execute();
        $db->close();
        echo "Ban Updated Successfully";
    } else {
        echo "Operation Canceled.";
    }
}

//the main function
function main()
{
    $cmd = $_POST["type"];
    if ($cmd === "create") {
        addUser();
    } else if ($cmd === "delete") {
        deleteUser();
    } else if ($cmd === "update") {
        changePassword();
    } else if ($cmd === "seeForms") {
        getForms();
    } else if ($cmd === "ban") {
        updateBan();
    }

}
main();
