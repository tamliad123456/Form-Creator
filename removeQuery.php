<?php include 'checkLogin.php';

/*
the function is for getting the user forms for deleting the current form
input: db
output: the guids of the forms
 */
function getUserForms($db)
{
    $username = $_SESSION["username"];
    $password = $_SESSION["password"];

    $getQuery = "SELECT guid FROM _users WHERE uName=? AND uPass=?";
    $statement = $db->prepare($getQuery);
    $statement->bindValue(1, $username);
    $statement->bindValue(2, $password);
    $result = $statement->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);
    if (isset($row["guid"])) {
        return $row["guid"];
    } else {
        return "";
    }
}

//the main function removing the guid
function main()
{
    $thisGuid = $_POST['guid'];
    $username = $_SESSION["username"];
    $password = $_SESSION["password"];
    $db = new SQLITE3("database.db");

    $guidsArr = getUserForms($db);
    $guidsArr = explode("&&", $guidsArr);
    if (in_array($thisGuid, $guidsArr)) {
        unset($guidsArr[array_search($thisGuid, $guidsArr)]);
        $updatedGuids = implode('&&', $guidsArr);
        $updateQuery = "UPDATE _users set guid=? WHERE uName=? AND uPass=?";
        $statement = $db->prepare($updateQuery);
        $statement->bindValue(1, $updatedGuids);
        $statement->bindValue(2, $username);
        $statement->bindValue(3, $password);
        $statement->execute();
        echo 'updated';

        $updateQuery = "DELETE FROM _queries WHERE formGUID=?";
        $statement = $db->prepare($updateQuery);
        $statement->bindValue(1, $thisGuid);
        $statement->execute();
        echo 'deleted';

        $updateQuery = "DELETE FROM _answers WHERE formGUID=?";
        $statement = $db->prepare($updateQuery);
        $statement->bindValue(1, $thisGuid);
        $statement->execute();
        echo 'deleted';
    }
    $db->close();
}

main();
