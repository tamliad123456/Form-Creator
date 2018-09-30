<?php 
    $title = "HomePage";
    $to_include_js = array("menu.js");
    include "startTemplate.php";
?>

<h1> Welcome to Form Creator you are logged on as <?php echo $_SESSION['username']; ?> </h1>

<?php include "closeTemplate.php"; ?>
