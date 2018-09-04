function post() {
    method = "post";
    path = "createQuery.php"

    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    document.body.appendChild(form);
    form.submit();
}