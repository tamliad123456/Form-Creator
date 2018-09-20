<!-- TODO
    statistics (only owners)
    answering (non logged users)
-->

<html id = "html">
    <head>
        <title>Menu</title>
        <script src="menu.js"></script>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="bootstrap.css">
    </head>

    <body id = "TheBody">
        <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-7 col-md-9">
                    <div class="card shadow-lg">
                        <div class="card-body p-4 p-md-5">

        <?php
        include 'checkLogin.php';
        function successfullLogin()
        {
            $allowed = array("Tamir", "Ziv", "Omri");
            echo "<center>";
            echo "<h1 class='display-4' style='margin:10%'>The user ".$_SESSION['username']." has logged on successfully</h1>";
            echo "<input type='button' style='margin:2%' value='Create Query' onclick='goToCreateQuery()' class='btn btn-primary btn-lg'>";
            echo "<input type='button' style='margin:2%' value='Show My Queries' onclick='goToGetAnswers()' class='btn btn-primary btn-lg'>";
            if (in_array($_SESSION['username'], $allowed))
            {
                echo "<input type='button' style='margin:2%' value='Admin Panel' onclick='goToAdminPanel()' class='btn btn-primary btn-lg'>";
            }
            else
            {
                echo "<input type='button' style='margin:2%' value='Lol not allowed' class='btn btn-primary btn-lg'>";
            }
            echo "<br><input type='button' style='margin:2%' value='Logout' onclick='removeCookie()' class='btn btn-primary btn-lg'>";
            echo '</center>';
        }
        successfullLogin();
        ?>
    </body>
</html>
