<?php
 error_reporting(E_ALL);
        ini_set("display_errors", 1);


$conn = new mysqli("localhost", "root", "", "ctf");

$login_erfolgreich = false;
$login_versuch = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user']) && isset($_POST['pass'])) {
$login_versuch = true;
$user = $_POST['user'];
$pass = $_POST['pass']; 

//Das ist die Sicherheitslücke, die die SQLi ermöglicht. Nutzername und Passwort werden ungeprüft SQL-Statement übergeben.
$sql = "SELECT * FROM users WHERE username= 'admin' AND username = '$user' AND password = '$pass'";

$result = $conn->query($sql);

if ($result && $result->num_rows>0) {
    $login_erfolgreich = true;
}
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTF: SQL-Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Press+Start+2P"> 
    <link rel="stylesheet" href="../assets/style/style.css?v=123">
</head>
<body>
    <div class="ctf-container">
        <?php 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         if ($login_versuch) {
            if ($login_erfolgreich) {
            echo "<h1>Login erfolgreich!</h1><br>";
            echo "<form method='post' action='combie.php'>
                    <input type='hidden' name='teilflag_sql' value='1'>
                    <input type='submit' value='Nächstes Rätsel' class='ctf-button'>
                  </form>";
      } else {
            echo "<h1>Login fehlgeschlagen :( </h1>";
            echo "<form method='post' action='SQL_Injection.php'>
               <button type='submit' class='ctf-button'>Züruck zum Login</button>
               </form>";
     } 
    }
     } else {
        echo "<h1>Kehre zum Login zurück!</h1>";
        echo "<form method='post' action='SQL_Injection.php'>
               <button type='submit' class='ctf-button'>Züruck zum Login</button>
               </form>";
      }
     
   ?>

    </div>
    
</body>
</html>
