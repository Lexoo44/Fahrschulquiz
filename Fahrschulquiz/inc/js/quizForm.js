const form = document.getElementById("QuizAnswers");


//object.onclick = function() {questionLink}

function questionLink(questionNumber) {
    document.questionForm.questionNumber.value = questionNumber;
    document.questionForm.submit();
    return false;
}