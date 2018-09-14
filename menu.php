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

        <?php include 'checkLogin.php';?>
        <?php
        function successfullLogin()
        {
            echo "<center>";
            echo "<h1 class='display-4' style='margin:10%'>The user ";
            echo "<script>document.write(getCookie('ronUName'));</script>";
            echo " has logged on successfully</h1>";
            echo "<input type='button' style='margin:2%' value='create a query' onclick='goToCreateQuery()' class='btn btn-primary btn-lg'>";
            echo "<input type='button' style='margin:2%' value='show answers for queries' onclick='goToGetAnswers()' class='btn btn-primary btn-lg'>";
            echo "<input type='button' style='margin:2%' value='logout' onclick='removeCookie()' class='btn btn-primary btn-lg'>";
            echo '</center>';
        }
        successfullLogin();
        ?>
    </body>
</html>
