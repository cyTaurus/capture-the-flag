<?php
    session_start();
    // Teilflag setzen von der vorherigen Challenge
    if (isset($_POST['teilflag_sql'])) {
    $_SESSION['teilflag_sql'] = $_POST['teilflag_sql']; // Teilflag für Anagramme setzen
    }

    $modalContent = "
                <h2>Hinweise zum kombinierten Rätsel</h2>
                <ul>
                    <li>Zahlen-Rätsel: Mit der Zahl kann man auch die Feuerwehr rufen.</li><br>
                    <li>Farben-Rätsel:
                        <ul>
                            <li>Der Farbcode in Hexadezimal zahlen sind wie folgt aufgebaut: RR:GG:BB</li><br>
                            <li>RR = Rot, GG = Grün, BB = Blau</li><br>
                            <li>Die Intensität der Farben wird durch die Hexadezimal-Zahlen dargestellt</li><br>
                            <li>#FF0000 ist nur rot zum Beispiel</li><br>
                            <li>Du kannst für die Umrechnung von Hexadezimal-Zahlen in Dezimalzahlen auch einen Umrecher im Internet verwenden</li><br>
                        </ul>
                    </li>
                    <li>Bild-Rätsel: Schau mal im Wasser nach (im unteren viertel, in der Mitte ungefähr)</li>
                </ul>
                ";

    include '../modal.php'; // Modal für Hinweise einbinden
?>


<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTF: Kombiniertes Rätsel</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Press+Start+2P"> 
    <link rel="stylesheet" href="../assets/style/style.css?v=123">
</head>
<body class="scrollable">
    <div class="ctf-container">
    <h1>Rätsel 4: Kombiniertes Rätsel</h1>
    <span>
        <button class="ctf-button" onclick="openModal()">Hinweise anzeigen</button>
    </span>
    <p>Jetzt musst du ein "kombiniertes Rätsel" lösen.</p>
    <p>Hierbei musst du drei kleine Rätsel lösen, um am Ende den richtigen Code einzugeben!</p>

    <!-- Zahlen-Rätsel -->
    <h2>Zahlen-Rätsel</h2>
    <p>Finde aus dem Text die richtige Zahl heraus:</p>
    <blockquote>
        Ich bin die kleinste dreistellige Zahl, die durch 7 und durch 4 teilbar ist. Welche Zahl bin ich?
    </blockquote>

    <!-- Farbenrätsel -->
    <h2>Farben-Rätsel</h2>
    <p>Du bekommst einen Hex-Code einer Farbe gegeben. Rechne damit die darunter stehende Gleichung im Dezimalsystem aus</p>
    <blockquote>
        Farbcode in Hexadezimal: <code>#1C5603</code>
        <span style="display:inline-block; width:20px; height:20px; background-color:#1C5603; border:1px solid #000; vertical-align:middle;"></span>
        <br>
        Gleichung: <code>2 &times; rot + grün - (blau - 10)</code> <small>Hinweis: die 2 und die 10 sind im Dezimalsystem</small>
    </blockquote>

    <!-- Bild-Rätsel -->
    <h2>Bild-Rätsel</h2>
    <p>In diesem Bild versteckt sich eine Zahl, finde diese.</p>
    <img src="../assets/images/combie.png" alt="Bild-Rätsel" id="combie-picture"> <br><br>

    <!-- Vergrößtertes Bild -->
    <div id="image-overlay" style="display:none;">
        <img src="../assets/images/combie.png" alt="Bild-Rätsel Vergrößert" id="combie-picture-large">
    </div>

    <!-- Eingabeformular für Code -->
    <h2>Code-Eingabe</h2>
    <p>Hier fügst du die Zahlen, welche du in den Rätseln herausgefunden hast, hinter einander ohne Leerzeichen ein </p>

    <form action="" method="POST">
        <label for="code">
            Code:
            <input type="number" id="code" name="code" required value="<?php echo isset($_POST['code']) ? htmlspecialchars($_POST['code']) : ''; ?>">
            <input type="submit" value="Code absenden" class="ctf-button">
        </label>
    </form>

    <?php
    if (isset($_POST['code'])) {
        $code = $_POST['code'];
        if ($code == 11214978) {
            echo "<p>Rätsel gelöst!<br>
           <form method='post' action='../ziel.php'>
               <input type='hidden' name='teilflag_combie' value='1'>
               <button type='submit' class='ctf-button'>Weiter</button>
           </form>";
        }
        else {
            echo "<p>Leider falsch :(</p>";
        }
    }
 ?>

</div>

    <!-- Skript um Bild zu vergrößern -->
    <script type="text/javascript">
        document.getElementById('combie-picture').onclick = function () {
            document.getElementById('image-overlay').style.display = 'flex';
        };
        document.getElementById('image-overlay').onclick = function () {
            this.style.display = 'none';
        };
    </script>

</body>
</html>