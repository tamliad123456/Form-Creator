<?php
include "checkLogin.php";

//array to check if you are an admin
$allowed = array(
    "Tamir",
    "Ziv",
    "Omri",
);

if (!in_array($_SESSION['username'], $allowed)) {
    header('Location: ' . "menu.php");
    die();
}

?>

<html>
    <head>
        <title>Admin Panel</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="bootstrap.css">
        <script src="menu.js"></script>
        <script src="Admin.js"></script>

    </head>
    <body onload = "loginWithCookie('Admin');">
    <?php include "back.php";?>

    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-7 col-md-9">
            <div class="card shadow-lg">
                <div class="card-body p-4 p-md-5">
                <center> <input type='button' style='margin:2%' value='Add new user' class='btn btn-primary btn-lg' onclick="createUser()"><br />
                <h1>Users List:</h1></center>
                <table>
                <?php
$db = new SQLite3('database.db');
$stmt = $db->prepare('SELECT uName, ban FROM _users');
$result = $stmt->execute();

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    echo '<tr>';
    echo "<td width=100%><h5><a href='editUser.php?id=" . htmlspecialchars($row['uName'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($row['uName'], ENT_QUOTES, 'UTF-8') . "</a></h5></td>";
    if ($row['ban'] <= 0) {
        echo "<td><input type='button' class='btn btn-primary btn-lg' style='background-color:green; border-color:green' value='" . htmlspecialchars($row['ban'], ENT_QUOTES, 'UTF-8') . "'></td>";
    } else if($row['ban'] <= 2) {
        echo "<td><input type='button' class='btn btn-primary btn-lg' style='background-color:orange; border-color:orange' value='" . htmlspecialchars($row['ban'], ENT_QUOTES, 'UTF-8') . "'></td>";
    }
    else {
        echo "<td><input type='button' class='btn btn-primary btn-lg' style='background-color:red; border-color:red' value='" . htmlspecialchars($row['ban'], ENT_QUOTES, 'UTF-8') . "'></td>";
    }

    echo '</tr>';

    // TODO: add btn to ban.

}

$db->close();
?>
                </table>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>