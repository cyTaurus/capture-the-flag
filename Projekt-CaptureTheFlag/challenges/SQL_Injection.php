<?php

session_start();
// Teilflag setzen von der vorherigen Challenge
if (isset($_POST['teilflag_encryption'])) {
    $_SESSION['teilflag_encryption'] = $_POST['teilflag_encryption']; // Teilflag für Encryption setzen
}


include '../databases/users.php';

$modalContent = "
                <h2>Hinweis zu SQL-Injection</h2>
                <ul>
                    <li>So sieht ein SQL-Statement aus, wenn du dich einloggst: SELECT * FROM users WHERE username = '\$user' AND password = '\$pass'</li><br>
                    <li>Versuche, dich mit dem 'admin'-Account einzuloggen.</li><br>
                    <li>Syntax: user' -- # oder nutze ein Statement, welches immer wahr ist im Passwortfeld: ___ OR 1= '1 </li>
                </ul>
                ";

include '../modal.php'; // Modal für Hinweise einbinden

?>


<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTF: SQL</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Press+Start+2P"> 
    <link rel="stylesheet" href="../assets/style/style.css?v=123">
    <link rel="icon" type="image/x-icon" href="../assets/images/CTFflag.png">
</head>

<body class="scrollable">
 <div class="ctf-container">
    <h1>Rätsel 3: SQL-Injection</h1>
    <span>
        <button class="ctf-button" onclick="openModal()">Hinweis anzeigen</button>
    </span>
    <p> Als Nächstes musst du dich hier mithilfe von SQL-Injection einloggen.</p>
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