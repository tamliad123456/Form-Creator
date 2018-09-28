/*
the function is for redirecting to createQuery
input: none
output: none
*/
function goToCreateQuery() {
    window.location.href = "createQuery.php";
}

/*
the function is for redirecting to getAnswers
input: none
output: none
*/
function goToGetAnswers() {
    window.location.href = "getAnswers.php";
}
/*
the function returnToMenu
input: none
output: none
*/
function returnToMenu() {
    window.location.href = "menu.php";
}

/*
the function is for redirecting to AdminPanel
input: none
output: none
*/
function goToAdminPanel() {
    window.location.href = "adminPanel.php";
}

/*
the function is removing the cookie for logout
input: none
output: none
*/
function LogOut() {
    deleteCookie("PHPSESSID");
    window.location.href = "index.php";
}

/*
the function is actually deleting the cookie
input: cookie name
output: none
*/
function deleteCookie(cname) {
    var d = new Date();
    d.setTime(d.getTime() - (1000 * 60 * 60 * 24));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + "; " + expires;

}

/*
the function is for creating a remove query post request
input: guid of what to remove
output: none
*/
function removeQuery(guid) {
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            location.reload();
        }
    };

    xhttp.open("POST", "removeQuery.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("guid=" + guid);

}


function updatePass() {
    var newPass = prompt("enter new pass: ");
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
            removeCookie();

        }
    };
    if (newPass == null)
    {
        alert("operation canceled");
    }
    else
    {
        xhttp.open("POST", "updatePass.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("newPass=" + newPass);
    }

}