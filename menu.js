function goToCreateQuery() {
    window.location.href = "createQuery.php";
}


function goToGetAnswers() {
    window.location.href = "getAnswers.php";
}


function loginWithCookie(check = 'notAdmin') {

    if(getCookie("connected") != "" && check != 'Admin')
    {
        window.location.href = "menu.php";
    }

}


function removeCookie()
{
    deleteCookie("connected");
    deleteCookie("PHPSESSID");
    window.location.href = "index.htm";
}

function deleteCookie(cname) {
    var d = new Date(); 
    d.setTime(d.getTime() - (1000*60*60*24)); 
    var expires = "expires=" + d.toGMTString(); 
    document.cookie = cname+"="+"; "+expires;
 
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
    window.location.href = "adminPanel.php";
}