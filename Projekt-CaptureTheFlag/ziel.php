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
    <h1>Herzlichen Glückwunsch</h1>
    <p>Du hast alle Rätsel gelöst!</p>

    <form method="post" action="index.php">
        <input type="hidden" name="action" value="ende">

        <button type="submit" class="ctf-button">
            <img src="assets/icons/flag-fill.svg" alt="Ziel-Flagge">
        </button>
    </form>
 </div>
</body>
</html>