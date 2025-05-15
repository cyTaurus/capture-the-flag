<?php
global $leaderboardHtml;
include 'databases/time.php';
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Capture The Flag</title>
</head>
<body>
    <h1>Willkommen bei Capture The Flag</h1>

    <p>Dein Ziel ist es, vier Rätsel zu lösen, um am Ende die Flagge einzusammeln</p>

    <h2>Test-Sektion</h2>

    <form method="post" action="">
        <input type="hidden" name="action" value="start">

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required maxlength="30">

        <button type="submit">Rätsel starten</button>
    </form>

    <form method="post" action="">
        <input type="hidden" name="action" value="ende">

        <button type="submit">Rätsel beenden</button>
    </form>

    <!-- Ausgabe Leaderbord -->
    <?php
        echo $leaderboardHtml;
    ?>

</body>
</html>