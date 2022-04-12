function validateQuestion()  {
    // Holle die Liste aller ausgewählter Radioboxen (checked).
 
    let radioboxes = document.querySelectorAll('input[type=radio]:checked');
    
    if (radioboxes.length === 0) {
        // Die liste der Radioboxen ist leer - es wurde nichts ausgewählt.
        setWarning("Bitte wähle eine Antwort aus!");
        return false; // Submit Aktion wird gestopt.
    }

    // Nach dem Auswahl einer Antwort: die erreichte Punkte zusammenzählen.
    let achievedPoints = 0; // Summe aller erreichten Punkte pro Frage.
    let points; // Anzahl der Punkte einer einzelnen Antwort.
    // oder kürzer als Liste: let achivedPoints = 0, points;

    for (let i = 0; i < radioboxes.length; i++) {
        points = radioboxes[i].value;  //Als "value" kommt ein String.
        points = parseInt(points);  // String in ganzze Zahl konvertieren.

        // Für richtige Antwort: points === 1,
        //     falsche Antwort: points === 0.
        achievedPoints = achievedPoints + points; // oder kürzer: achievedPoints += points;

        }
        alert (achievedPoints);

        // schreibe die erreichte Punktzahl ins Hidden Field "achivedPoints".
        let hiddenField = document.getElementById("achievedPoints");
        hiddenField.value = achievedPoints;
}