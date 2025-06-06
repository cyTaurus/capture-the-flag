<?php
$letters = array(range('A', 'Z')); // Array mit Buchstaben von A bis Z
$key = 3; // Schlüssel für die Verschlüsselung
$text = "Du bist ein Schritt weiter zum Ziel!"; // Text, der verschlüsselt werden soll

// Funktion zur Verschlüsselung des Textes
function encrypt($text, $key) {
    global $letters;
    $encryptedText = '';
    $text = strtoupper($text); // Text in Großbuchstaben umwandeln

    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        if (in_array($char, $letters[0])) {
            // Buchstabe verschlüsseln
            $index = array_search($char, $letters[0]);
            $newIndex = ($index + $key) % 26;
            $encryptedText .= $letters[0][$newIndex];
        } else {
            // Nicht-Buchstaben unverändert lassen
            $encryptedText .= $char;
        }
    }

    return $encryptedText;
}

// Funktion zur Überprüfung der Eingabe
function isAnswerCorrect() {
    if(isset($_POST['eingabeText'])) {
        global $text;
        $eingabeText = $_POST['eingabeText'];
        $eingabeText = strtoupper($eingabeText); // Eingabe-Text in Großbuchstaben umwandeln
        $originalText = strtoupper($text); // Original-Text in Großbuchstaben umwandeln

        if($eingabeText == $originalText) {
            // Button zur nächsten Challenge
            return "Rätsel gelöst!<br>
           <form method='get' action='SQL_Injection.php'> //Hier den Link zur nächsten Challenge anpassen
               <button type='submit'>Weiter zur nächsten Challenge</button>
           </form>";
        } else {
            return "Leider falsch :(";
        }
    }
    return "";
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capture The Flag: Cäsar-Verschlüsselung</title>
</head>
<body>
    <h1>Cäsar-Verschlüsselung</h1>
    <p>Dir liegt folgender Text vor, welcher mit der Cäsar-Verschlüsselung codiert wurde</p>
    <p>Den Schlüssel, den du verwenden sollst, ist: <strong>3</strong></p>

    <p>
        <?php echo encrypt($text, $key);?>
    </p>

    <form method="post" action="">
        <label for="eingabeText">Eingabe Lösung:</label> <br>
        <textarea id="eingabeText" name="eingabeText" rows="5" cols="50" placeholder="Hier den entschlüsselten Text eingeben"><?php echo isset($_POST['eingabeText']) ? htmlspecialchars($_POST['eingabeText']) : ''; ?></textarea>
        <button type="submit">Lösung überprüfen</button>
    </form>

    <p>
        <?php echo isAnswerCorrect(); ?>
    </p>

</body>
</html>