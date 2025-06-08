<?php
global $leaderboardHtml;
include 'databases/time.php';
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <title>Capture The Flag</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Press+Start+2P"> 
    <link rel="stylesheet" href="assets/style/style.css?v=124"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!--nötig für die Aufsführung des verwendeten Skripts-->
    <script src="index.js"></script>
</head>

<body class>

 <script>
    $(function () {
        reveal("#message", "Dein Ziel ist es, vier Rätsel zu lösen, um am Ende die Flagge einzusammeln", 0, 70);   
     });
  </script>

 <div class="layout">
  <div class="ctf-container">
    <h1>Willkommen bei Capture The Flag</h1>
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