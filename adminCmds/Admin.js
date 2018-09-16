function createUser()
{
    var username = window.prompt("please enter new username: ");
    var hashedPass = window.prompt("please enter the hashed password: (sha256).lower");

    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
        }
    };

    xhttp.open("POST", "adminCmds.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("type=create&uName=" + username + "&pass=" + hashedPass);
}