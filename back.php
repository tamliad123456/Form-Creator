<?php

$gotFrom = $_SERVER["HTTP_REFERER"];
echo '                <link rel="stylesheet" href="bootstrap.css">';
//style="margin-right:8%"
echo "<input type='button' onclick='window.location.replace(\"$gotFrom\");' value='<' style='margin-left: 5%; height: 70px' class='btn btn-primary btn-lg'>";
?>