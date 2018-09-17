var qId = 1

function getCardWithId() {
    //const
    var card = '<div class="row justify-content-center" id = "q' + qId.toString() + '">\
    <div class="col-xl-6 col-lg-7 col-md-9"> \
    <div class="card shadow-lg" id="card" style="padding:2%;margin-top:1%"> \
    <div class="input-group input-group-lg pb-2">'
    return card;
}

function getDiv() {
    //const
    return '<div class="input-group input-group-lg pb-2">';
}

function getQuestionTitle(type) {
    //const
    return '<h4 style="margin-top:1%;margin-right:1.5%">' + type + ': </h4>';
}

function getInput(placeholder = "Question", type = "input") {
    //const
    return '<input type="text" class="form-control" placeholder="' + placeholder + '" style="margin-left:2%; margin-right:2%" name="q' + qId + type + '">';
}

function getRemoveBtn(qId) {
    //const
    return '<input type="button" id="rem' + qId.toString() + '" onclick="removeQuestion(\'q' + qId.toString() + '\')" style="margin:auto;line-height: 0px;background-color: red;border-color: red;text-align:left;" value="X" class="btn btn-primary btn-lg">'
}

function closeDivs(num) {
    //closes a number of divs
    var divToClose = "";

    for (var i = 0; i < num; i++) {
        divToClose += "</div>"
    }

    return divToClose;
}

function addQuestion() {
    // Add an element to the html data
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
    var check = false;
    for (var i = 1; i <= qId; i++) {
        if (!document.getElementById('q' + i.toString())) {
            check = true;
        } else if (check) {
            document.getElementById('q' + i.toString()).id = 'q' + (i - 1).toString();
            document.getElementById('rem' + i.toString()).setAttribute("onClick", "removeQuestion('q" + (i - 1).toString() + "')");
            document.getElementById('rem' + i.toString()).id = 'rem' + (i - 1).toString();
        }

    }
    qId--;
}

function addRadioOrCheckBox(checkboxOrRadio) {
    //Adding a checkbox or radio option
    var options = "";
    do {
        options = prompt("enter number of options: ");
        if(options == "" || isNaN(options))
        {
            alert("Please insert only a number");
        }
        else if(!options)
        {
            return;
        }
        else if(options < 2)
        {
            alert("Please insert numbers greater than 1.");
        }
    }
    while (options == "" || isNaN(options) || options < 2);

    var addQuest;
    addQuest = getCardWithId(qId);
    if (checkboxOrRadio == "radio") {
        addQuest += getQuestionTitle("Radio");
    } else if (checkboxOrRadio == "checkbox") {
        addQuest += getQuestionTitle("Checkbox");
    } else {
        alert("Stop Fucking messing with my code!!!");
    }
    addQuest += getInput(checkboxOrRadio, checkboxOrRadio);
    addQuest += getRemoveBtn(qId);
    addQuest += closeDivs(1);
    for (var i = 1; i <= options; i++) {
        addQuest += getDiv();
        addQuest += getQuestionTitle("Option" + i.toString());
        addQuest += getInput("Option" + i.toString(), "&&" + "option" + i.toString());
        addQuest += closeDivs(1);
    }
    addQuest += closeDivs(3);
    document.getElementById("TheBody").insertAdjacentHTML('beforeend', addQuest);

    qId++;

}