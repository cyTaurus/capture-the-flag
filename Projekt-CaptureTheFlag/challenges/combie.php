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
    <h1>Kombiniertes Rätsel</h1>
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
           <form method='get' action='../ziel.php'> 
               <button type='submit' class='ctf-button'>Nächstes Rätsel</button>
           </form>";
        }
        else {
            echo "<p>Leider falsch :(</p>";
        }
    }
 ?>

</div>

</body>
</html>