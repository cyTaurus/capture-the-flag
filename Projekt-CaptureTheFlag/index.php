<?php
global $leaderboardHtml;
include 'databases/time.php';

// Ausgabe benötigte Zeit und Platzierung für User
if (isset($_POST['action']) && $_POST['action'] == 'ende') {

    // Teilflags zurücksetzen
    $_SESSION['teilflag_combie'] = "";
    $_SESSION['teilflag_encryption'] = "";
    $_SESSION['teilflag_sql'] = "";
    $_SESSION['teilflag_ana'] = "";

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        list($neededTime, $rank) = neededTimeAndRank($username);
        $finishMessage = "
            <h3>Herzlichen Glückwunsch! Du hast die Flagge eingesammelt.</h3>
            <p><strong>Zeit:</strong> $neededTime<br>
            <strong>Platzierung:</strong> $rank</p>
            ";
    } else {
        $finishMessage = "Kein User angemeldet";
    }
}

// Schließen der Datenbankverbindung erst nach der Ausgabe
if (isset($conn) && $conn instanceof mysqli) {
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <title>Capture The Flag</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Press+Start+2P"> 
    <link rel="stylesheet" href="assets/style/style.css?v=121"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!--nötig für die Ausführung des verwendeten Skripts-->
    <script src="index.js"></script>
</head>

<body class="scrollable">

 <script>
    $(function () {
        reveal("#message", "Dein Ziel ist es, vier Rätsel zu lösen, um am Ende die Flagge einzusammeln", 0, 70);   
     });
  </script>

 <div class="layout">
  <div class="ctf-container">
    <h1>Willkommen bei Capture The Flag</h1>

    <br>
    <!-- Ausgabe der Nachricht, wenn User das Rätsel erfolgreich beendet hat -->
    <?php echo isset($finishMessage) ? $finishMessage : ""; ?>
    <br>

    <img id="HomepageImage" src="assets/images/homepage_PC.png" alt="test_image">

    <!--hier wird der Text mit dem Skript Buchstabe für Buchstabe ausgegeben-->
    <div id="message-container">
      <span id="message"></span><span class="cursor">|</span>
    </div>

    <form method="post" action="">
        <input type="hidden" name="action" value="start">

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required maxlength="30">
        <br><br>
        <button type="submit" class="ctf-button">Rätsel starten</button>
    </form>

  </div>


    <!-- Ausgabe Leaderbord -->
   <div id="leaderboard">
    <?php
        echo $leaderboardHtml;
    ?>
   </div>
 </div>
</body>
</html>