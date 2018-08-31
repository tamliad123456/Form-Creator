
var qId = 2

function appendQuestions()
{    
    // Add an element to the html data
    var addQuest = '<div class="input-group input-group-lg pb-2" id = "q' + qId.toString() + '"><h4 style="margin-top:1%;margin-right:1.5%">Question: </h4><input type="text" class="form-control" placeholder="Question" aria-label="Search" name= "Question">                            <input type="button" onclick="removeQuestion(\'q' + qId.toString() + '\')" style="margin:2%;width: 5%; height: 5%; background-color: red; border-color: red" value="-" class="btn btn-primary btn-lg"></div>';
    document.getElementById("card").insertAdjacentHTML('beforeend',addQuest);

}

function removeQuestion(q) 
{
    // Removes an element from the document
    var element = document.getElementById(q);
    element.remove(element);
}