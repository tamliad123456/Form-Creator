function createUser()
{
    var username = window.prompt("please enter new username: ");
    var hashedPass = window.prompt("please enter the hashed password: (sha256).lower");

    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
            location.reload();
        }
    };

    xhttp.open("POST", "adminCmds.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("type=create&uName=" + username + "&pass=" + hashedPass);
}

function updatePassword(username)
{
    var hashedPass = window.prompt("please enter the hashed password: (sha256).lower");

    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
            location.reload();
        }
    };

    xhttp.open("POST", "adminCmds.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("type=update&uName=" + username + "&pass=" + hashedPass);
}

function deleteUser(uid)
{
    var pass = window.prompt("Please enter admin pass: ");
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
            if (!this.responseText.includes("failed."))
            {
                window.location = "adminPanel.php";
            }
        }
    };

    xhttp.open("POST", "adminCmds.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("type=delete&uName=" + uid + "&pass=" + pass);
}

function seeForms(username)
{
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (!this.responseText.includes("failed."))
            {
                var check = this.responseText;
                document.getElementById("lastDiv").innerHTML =check;

            }
        }
    };

    xhttp.open("POST", "adminCmds.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("type=seeForms&uName=" + username);
}

function updateBan(username)
{
    var ban = prompt("Enter ban level: ");
    if(!isNaN(ban))
    {
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                if (!this.responseText.includes("failed."))
                {
                    alert(this.responseText);
                }
            }
        };

        xhttp.open("POST", "adminCmds.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("type=ban&uName=" + username + "&&ban=" + ban);
    }
    else{
        alert("you didnt enter a number!!");
    }
}