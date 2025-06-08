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
           <form method='get' action='SQL_Injection.php'> 
               <button type='submit'class='ctf-button'>Weiter zur nächsten Challenge</button>
           </form>";
        } else {
            return "Leider falsch :(";
        }
    }
    return "";
}

// Definiert Modal-Inhalt
$modalContent = "
                <h2>Hinweis zur Cäsar-Verschlüsselung</h2>
                <ul>
                    <li>Bei der Cäsar-Verschlüsselung werden die Buchstaben um eine gewisse Anzahl an Stellen (Schlüssel) verschoben</li><br>
                    <li>In diesem Fall ist der Schlüssel 3, also werden die Buchstaben um drei Stellen verschoben</li><br>
                    <li>Beispiel: A --> D, B --> E, C --> F, usw.</li>
                </ul>
                ";
include '../modal.php'; // Modal für Hinweise einbinden

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTF: Cäsar-Verschlüsselung</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Press+Start+2P"> 
    <link rel="stylesheet" href="../assets/style/style.css?v=124"> 

</head>
<body>
 <div class="ctf-container">
    <h1>Cäsar-Verschlüsselung</h1>
    <span>
        <button class="ctf-button" onclick="openModal()">Hinweise anzeigen</button>
    </span>
    <p>Dir liegt folgender Text vor, welcher mit der Cäsar-Verschlüsselung codiert wurde.</p>
    <p>Der Schlüssel, den du verwenden sollst, ist: <strong>3</strong></p>

    <p>
        <?php echo encrypt($text, $key);?>
    </p>

    <form method="post" action="">
        <label for="eingabeText">Eingabe Lösung:</label> <br>
        <textarea id="eingabeText" name="eingabeText" rows="5" cols="50" placeholder="Hier den entschlüsselten Text eingeben"><?php echo isset($_POST['eingabeText']) ? htmlspecialchars($_POST['eingabeText']) : ''; ?></textarea><br>
        <button type="submit" class="ctf-button">Lösung überprüfen</button>
    </form>

    <p>
        <?php echo isAnswerCorrect(); ?>
    </p>
</div>

</body>
</html>