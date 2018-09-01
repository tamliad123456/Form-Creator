
var qId = 1

function getCardWithId() {
    var card = '<div class="row justify-content-center" id = "q' + qId.toString() + '" style="margin:2%">\
    <div class="col-xl-6 col-lg-7 col-md-9"> \
    <div class="card shadow-lg" id="card" style="padding:2%"> \
    <div class="input-group input-group-lg pb-2">'
    return card;
}

function getDiv() {
    return '<div class="input-group input-group-lg pb-2">';
}

function getQuestionTitle(type) {
    return '<h4 style="margin-top:1%;margin-right:1.5%">' + type + ': </h4>';
}

function getInput(placeholder = "Question") {
    return '<input type="text" class="form-control" placeholder="' + placeholder + '" style="margin-left:2%; margin-right:2%">';
}

function getRemoveBtn(qId) {
    return '<input type="button" onclick="removeQuestion(\'q' + qId.toString() + '\')" style="margin:auto; line-height: 0px;width: 5%; height: 5%; background-color: red; border-color: red; text-align:center" value="-" class="btn btn-primary btn-lg">'
}

function closeDivs(num) {
    var divToClose = "";

    for (var i = 0; i < num; i++) {
        divToClose += "</div>"
    }

    return divToClose;
}

function addQuestion() {
    // Add an element to the html data
    //var addQuest = '<div class="input-group input-group-lg pb-2" id = "q' + qId.toString() + '"><h4 style="margin-top:1%;margin-right:1.5%">Question: </h4><input type="text" class="form-control" placeholder="Question" aria-label="Search" name= "Question"><input type="button" onclick="removeQuestion(\'q' + qId.toString() + '\')" style="margin:auto; line-height: 0px;width: 5%; height: 5%; background-color: red; border-color: red; text-align:center" value="-" class="btn btn-primary btn-lg"></div>';
    //document.getElementById("card").insertAdjacentHTML('beforeend', addQuest);
    var addQuest = getCardWithId(qId);
    addQuest += getQuestionTitle("Question");
    addQuest += getInput();
    addQuest += getRemoveBtn(qId);
    addQuest += closeDivs(4);
    document.getElementById("TheBody").insertAdjacentHTML('beforeend', addQuest);
    qId++;
}

function removeQuestion(q) {
    // Removes an element from the document
    var element = document.getElementById(q);
    element.remove(element);
}

function addRadioOrCheckBox(checkboxOrRadio) {
    //Adding a checkbox or radio option
    var options = prompt("enter number of options: ")
    var addQuest;
    addQuest = getCardWithId(qId);
    if (checkboxOrRadio == "radio") {
        addQuest += getQuestionTitle("Radio");
    }
    else if (checkboxOrRadio == "checkbox") {
        addQuest += getQuestionTitle("Checkbox");
    }
    else {
        alert("Stop Fucking messing with my code!!!");
    }
    addQuest += getInput();
    addQuest += getRemoveBtn(qId);
    addQuest += closeDivs(1);
    for (var i = 0; i < options; i++) {
        addQuest += getDiv();
        addQuest += getQuestionTitle("Option" + (i + 1).toString());
        addQuest += getInput("Option" + (i + 1).toString());
        addQuest += closeDivs(1);
    }
    addQuest += closeDivs(3);
    document.getElementById("TheBody").insertAdjacentHTML('beforeend', addQuest);

}