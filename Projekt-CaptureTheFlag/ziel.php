<?php
    session_start();

    // Teilflag setzen von der vorherigen Challenge
    if (isset($_POST['teilflag_combie'])) {
        $_SESSION['teilflag_combie'] = $_POST['teilflag_combie'];
    }

    // Array für fehlende Rätsel
    $fehlende = [];
    if (empty($_SESSION['teilflag_ana'])) {
        $fehlende[] = "<a href='challenges/anagramms.php'>Anagramm-Rätsel</a>";
    }
    if (empty($_SESSION['teilflag_encryption'])) {
        $fehlende[] = "<a href='challenges/encryption.php'>Verschlüsselungs-Rätsel</a>";
    }
    if (empty($_SESSION['teilflag_sql'])) {
        $fehlende[] = "<a href='challenges/SQL_Injection.php'>SQL-Injection-Rätsel</a>";
    }
    if (empty($_SESSION['teilflag_combie'])) {
        $fehlende[] = "<a href='challenges/combie.php'>Kombiniertes Rätsel</a>";
    }

    // Variable für Fehlermeldung
    $errorMessage = "";

    // Wenn es fehlende Rätsel gibt, erstelle die Fehlermeldung
    if (!empty($fehlende)) {
        $errorMessage = "<div class='error-message'>";
        $errorMessage .= "<h2>Du hast nicht alle Rätsel gelöst!</h2>";
        $errorMessage .= "<p>Bitte löse noch folgende Rätsel:</p>";
        $errorMessage .= "<ul>";
        foreach ($fehlende as $link) {
            $errorMessage .= "<li>$link</li><br>";
        }
        $errorMessage .= "</ul></div>";
    }
?>

<!DOCTYPE html>
<html lang="de">

    <head>
        <title>CTF: Ziel</title>
        <meta charset="utf-8" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Press+Start+2P">
        <link rel="stylesheet" href="./assets/style/style.css?v=123">
    </head>

    <body>
    <div class="ctf-container">

        <!-- Ausgabe der Fehlermeldung, wenn Rätsel nicht gelöst sind -->
        <?php if (!empty($errorMessage)): ?>
        <?php echo $errorMessage; ?>
        <?php else: ?>

        <!-- Ausgabe wenn alle Rätsel gelöst sind -->
        <h1>Herzlichen Glückwunsch</h1>
        <p>Du hast alle Rätsel gelöst!</p>

        <form method="post" action="index.php">
            <input type="hidden" name="action" value="ende">
            <p>Drücke die Ziel-Flagge, um das CTF zu beenden.</p>
            <button type="submit" class="ctf-button">
                <img src="assets/icons/flag-fill.svg" alt="Ziel-Flagge">
            </button>
        </form>

    <?php endif; ?>

    </div>
    </body>

</html>