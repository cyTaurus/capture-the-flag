<?php

include '../databases/users.php';

$modalContent = "Hier deine Hinweise einfügen :)";

include '../modal.php'; // Modal für Hinweise einbinden

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTF: SQL</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Press+Start+2P"> 
    <link rel="stylesheet" href="../assets/style/style.css?v=123">
</head>
<body class="scrollable">
 <div class="ctf-container">
    <h1>SQL-Injection</h1>
    <span>
        <button class="ctf-button" onclick="openModal()">Hinweis anzeigen</button>
    </span>
    <p> Als nächstes musst du dich hier mithilfe von SQL-Injection einloggen.</p>
 <form method="POST" action="login.php" class="login-field">
    <label for="user">Benutzername: </label>
     <input type="text" name="user" id="user"> 
     <label for="pass">Passwort: </label>
     <input type="password" name="pass" id="pass"> 
    <input type="submit" value="Einloggen" class="ctf-button">
 </form>
</div>
</body>
</html>