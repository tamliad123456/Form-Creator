
var qId = 1

function addQuestion() {
    // Add an element to the html data
    var addQuest = '<div class="input-group input-group-lg pb-2" id = "q' + qId.toString() + '"><h4 style="margin-top:1%;margin-right:1.5%">Question: </h4><input type="text" class="form-control" placeholder="Question" aria-label="Search" name= "Question"><input type="button" onclick="removeQuestion(\'q' + qId.toString() + '\')" style="margin:auto; line-height: 0px;width: 5%; height: 5%; background-color: red; border-color: red; text-align:center" value="-" class="btn btn-primary btn-lg"></div>';
    document.getElementById("card").insertAdjacentHTML('beforeend', addQuest);

}

function removeQuestion(q) {
    // Removes an element from the document
    var element = document.getElementById(q);
    element.remove(element);
}

function addRadioOrCheckBox(checkboxOrRadio)
{
    var options = prompt("enter number of options: ")
    var addQuest;
    if(checkboxOrRadio == "radio")
    {
        addQuest = '<div class="input-group input-group-lg pb-2" id = "q' + qId.toString() + '"><h4 style="margin-top:1%;margin-right:1.5%">Radio Question: </h4><input type="text" class="form-control" placeholder="Question" aria-label="Search" name= "Question"><input type="button" onclick="removeQuestion(\'q' + qId.toString() + '\')" style="margin:auto; line-height: 0px;width: 5%; height: 5%; background-color: red; border-color: red; text-align:center" value="-" class="btn btn-primary btn-lg">';
    }
    else if(checkboxOrRadio == "checkbox")
    {
        addQuest = '<div class="input-group input-group-lg pb-2" id = "q' + qId.toString() + '"><h4 style="margin-top:1%;margin-right:1.5%">CheckBox Question: </h4><input type="text" class="form-control" placeholder="Question" aria-label="Search" name= "Question"><input type="button" onclick="removeQuestion(\'q' + qId.toString() + '\')" style="margin:auto; line-height: 0px;width: 5%; height: 5%; background-color: red; border-color: red; text-align:center" value="-" class="btn btn-primary btn-lg">';
    }
    else
    {
        alert("Stop Fucking messing with my code!!!");
    }
    for(var i = 0; i < options; i++)
    {
        addQuest += '<div class="input-group input-group-lg pb-2" id = "q' + qId.toString() + (i + 1).toString() + '"><h4 style="margin-top:1%;margin-right:1.5%">option' + (i + 1).toString() + ': </h4><input type="text" class="form-control" placeholder="option' + (i + 1).toString() + '" aria-label="Search" name= "Question">';
    }
    addQuest += "</div>"
    document.getElementById("card").insertAdjacentHTML('beforeend', addQuest);

}