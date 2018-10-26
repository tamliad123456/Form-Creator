<?php
$title = "HomePage";
$to_include_js = array("menu.js", "addQuestions.js");
include "startTemplate.php";
?>

<h1>welcome to form creation</h1>
<br>
<input type="button" onclick="addQuestion()" style="margin:2%" value="Add Question" class="btn btn-primary btn-lg">
<input type="button" onclick="addRadioOrCheckBox('radio')" style="margin:2%" value="Add Radio" class="btn btn-primary btn-lg"\>
<input type="button" onclick="addRadioOrCheckBox('checkbox')" style="margin:2%" value="Add CheckBox" class="btn btn-primary btn-lg">
</center>
<center>
    <input type="submit" style="margin:2%" value="Submit Questions" class="btn btn-primary btn-lg">
</center>
<?php include "closeTemplate.php";?>
