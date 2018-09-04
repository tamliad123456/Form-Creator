function post(username, password) {
    method = "post";
    path = "createQuery.php"

    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    //add the username to the post
    var hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", "Username");
    hiddenField.setAttribute("value", username);

    form.appendChild(hiddenField);

    //add the password to the post
    hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", "Password");
    hiddenField.setAttribute("value", password);

    form.appendChild(hiddenField);

    document.body.appendChild(form);
    form.submit();
}