function validateQuestion()  {
    let radioboxes = document.querySelectorAll('input[type=radio]:checked');
    
    if (radioboxes.length === 0) {
        setWarning("Bitte wähle eine Antwort aus!");
        return false;
    }

    let achievedPoints = 0;
    for (let i = 0; i < radioboxes.length; i++) {
        points = radioboxes[i].value; 
        points = parseInt(points);

        achievedPoints = achievedPoints + points;

        }
        //alert (achievedPoints);
        let hiddenField = document.getElementById("achievedPoints");
        hiddenField.value = achievedPoints;
}
function setWarning(Text) {
    let warningElement=document.getElementById("validation-warning"); //is thtat the line's end?
    warningElement.innerText = text;
}