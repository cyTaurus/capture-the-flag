<?php

include '../databases/users.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Rätsel 4: SQL-Injection</h1>
    <p> Als nächstes musst du dich hier mithilfe von SQL-Injection einloggen.</p>
 <form method="POST" action="login.php">
     Benutzername: <input type="text" name="user"><br>
    Passwort: <input type="password" name="pass"><br>
    <input type="submit" value="Einloggen">
 </form>
</body>
</html>