<?php 
    $title = "HomePage";
    $to_include_js = array("menu.js");
    include "startTemplate.php";
?>

<h1> Welcome to Form Creator you are logged on as <?php echo $_SESSION['username']; ?> </h1>
<h5 class="question"> What is your name? </h5>
<span class="type"> Type </span>
<input type="text" class="input-text">
<br>
<input type="radio" name="demo" value="one" id="radio-one" class="form-radio"><label class="form-lable" for="radio-one">Radio</label>
<br><br><br>
<input type="radio" name="demo" value="one" id="radio-one" class="form-radio"><label class="form-lable" for="radio-one">Radio</label>
<br><br><br>
<input type="radio" name="demo" value="one" id="radio-one" class="form-radio"><label class="form-lable" for="radio-one">Radio</label>
<br><br><br>
<h5 class="question"> another question? </h5>
<input type="checkbox" class="form-checkbox" id="check-one" checked><label for="check-one" class="form-lable">Checkbox</label>
<br><br><br>
<input type="checkbox" class="form-checkbox" id="check-one" checked><label for="check-one" class="form-lable">Checkbox</label>
<br><br><br>
<input type="checkbox" class="form-checkbox" id="check-one" checked><label for="check-one" class="form-lable">Checkbox</label>
<br><br><br>
<?php include "closeTemplate.php"; ?>
