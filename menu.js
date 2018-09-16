function goToCreateQuery() {
    window.location.href = "createQuery.php";
}


function goToGetAnswers() {
    window.location.href = "getAnswers.php";
}

function loginWithCookie(check = 'notAdmin') {
    var loginUname = getCookie("ronUName");
    var loginPass = getCookie("ronPass");

    if(loginPass != "" && loginUname != "")
    {
        if(check != 'Admin')
        {
            postToMenu(loginUname, loginPass);
        }
    }
}


function removeCookie()
{
    deleteCookie("ronUName");
    deleteCookie("ronPass");
    window.location.href = "index.htm";
}

function deleteCookie(cname) {
    var d = new Date(); 
    d.setTime(d.getTime() - (1000*60*60*24)); 
    var expires = "expires=" + d.toGMTString(); 
    document.cookie = cname+"="+"; "+expires;
 
}

function postToMenu(Username, Password) {
    method = "post";

    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", "menu.php");

    var hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", "Username");
    hiddenField.setAttribute("value", Username);

    form.appendChild(hiddenField);

    hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", "Password");
    hiddenField.setAttribute("value", Password);

    form.appendChild(hiddenField);

    hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", "alreadyHashed");
    hiddenField.setAttribute("value", "");

    form.appendChild(hiddenField);

    document.body.appendChild(form);
    form.submit();
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

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


function goToAdminPanel()
{
    window.location.href = "adminCmds/adminPanel.php";
}