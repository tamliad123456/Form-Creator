var qId = 1


function getQuestionTitle(type) {
    //const
    return '<label class="form-lable">' + type + '</label>';
}

function getInput(placeholder = "Question", type = "input") {
    //const
    return '<input type="text" placeholder="' + placeholder + '" id="radio-one" name="q' + qId + type + '" class="input-text">';
}

function getRemoveBtn(qId) {
    //const
    return '<input type="button" id="rem' + qId.toString() + '" onclick="removeQuestion(\'q' + qId.toString() + '\')" style="margin:auto;line-height: 0px;background-color: red;border-color: red;text-align:left;" value="X" class="btn">'
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
    var addQuest = "";
    //var addQuest = getCardWithId(qId);
    addQuest += getQuestionTitle("Question");
    addQuest += getInput();
    addQuest += getRemoveBtn(qId);
    addQuest += closeDivs(4);
    document.getElementById("card").insertAdjacentHTML('beforeend', addQuest);
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
        if (options == "" || isNaN(options)) {
            alert("Please insert only a number");
        } else if (!options) {
            return;
        } else if (options < 2 || options > 6) {
            alert("Please insert numbers greater than 1 and less that 6.");
        }
    }
    while (options == "" || isNaN(options) || options < 2 || options > 6);

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