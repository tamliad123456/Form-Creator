<html>

<head>
    <title>Login</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="menu.js"></script>
    <link rel="stylesheet" href="bootstrap.css">
</head>
<?php 
    session_start();
    function checkIfLoggedOn()
    {
        if(isset($_SESSION["connected"]))
        {
           header("Location: ", "menu.php"); 
        }
    }

    checkIfLoggedOn();
    ?>
<body onload="loginWithCookie();">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-7 col-md-9">
            <div class="card shadow-lg">
                <div class="card-body p-4 p-md-5">
                    <center>
                        <h1 class="display-4" style="margin:10%">Login to Create a Query</h1>
                    </center>
                    <form action="menu.php" method="POST">
                        <div class="input-group input-group-lg pb-2">
                            <h4 style="margin-top:1%;margin-right:1.5%">Username: </h4>
                            <input type="text" class="form-control" placeholder="Username" name="Username">
                        </div>
                        <div class="input-group input-group-lg pb-2">
                            <h4 style="margin-top:1%;margin-right:2.8%">Password: </h4>
                            <input type="password" class="form-control" placeholder="Password" name="Password">
                        </div>
                        <center>
                            <input type="submit" style="margin:2%" value="Login" class="btn btn-primary btn-lg">
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>