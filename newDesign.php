<?php include "checkLogin.php" ?>
<html>
    <head>
        <link rel="stylesheet" href="newDesign.css">
        <title> check </title>
    </head>
    <body>
        <div class="menu">
            <button class="btn-menu" style="font-size: 1.5em" onclick="window.location.href='menu.php'"> FormCreator </button>
            <div class="menu-btnDiv">
                <button class="btn-menu" onclick="window.location.href='index.php'"> LogOut </button>
                <?php if(checkAdmin(true))
                { ?>
                    <button class="btn-menu" onclick="window.location.href='AdminPanel.php'"> Admin Panel </button>
                <?php } ?>
                <div class="dropdown">
                    <button class="dropbtn">Queries</button>
                    <div class="dropdown-content">
                        <a href="menu.php">Show Queries</a>
                        <a href="CreateQuery.php">Create Query</a>
                    </div>
                </div>
                <button class="btn-menu" onclick="window.location.href='Menu.php'"> Change Password </button>
                <button class="btn-menu" onclick="window.location.href='Menu.php'"> Menu </button>
            </div>
        </div>
        <div class="card">
            <button class="btn">Hello</button>
            <button class="btn">how are you?</button>
            <h1> Hello there my friends </h1>
            <h1> Hello there my friends </h1>
        </div>
    </body>
</html>
