/*
the function is for posting to create new user
input: none
output: none
*/

function createUser() {
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

/*
the function is for posting to update a user password
input: username
output: none
*/
function updatePassword(username) {
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

/*
the function is for posting to delete a user
input: username
output: none
*/
function deleteUser(username) {
    var pass = window.prompt("Please enter admin pass: ");
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
            if (!this.responseText.includes("failed.")) {
                window.location = "adminPanel.php";
            }
        }
    };

    xhttp.open("POST", "adminCmds.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("type=delete&uName=" + username + "&pass=" + pass);
}

/*
the function is for posting to get all the forms the user have
input: username
output: none
*/
function seeForms(username) {
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (!this.responseText.includes("failed.")) {
                document.getElementById("lastDiv").innerHTML = this.responseText;
            }
        }
    };

    xhttp.open("POST", "adminCmds.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("type=seeForms&uName=" + username);
}

/*
the function is for posting to update the ban level for the user
input: username
output: none
*/
function updateBan(username) {
    var ban = prompt("Enter ban level: ");
    if (!isNaN(ban)) {
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                if (!this.responseText.includes("failed.")) {
                    alert(this.responseText);
                }
            }
        };

        xhttp.open("POST", "adminCmds.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("type=ban&uName=" + username + "&&ban=" + ban);
    }
    else {
        alert("you didnt enter a number!!");
    }
}