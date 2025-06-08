<?php

 error_reporting(E_ALL);
        ini_set("display_errors", 1);


$conn = new mysqli("localhost", "root", "", "ctf");

$user = $_POST['user'];
$pass = $_POST['pass'];

$sql = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
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
        if ($result->num_rows > 0) {
            echo "<h1>Login erfolgreich!</h1><br>";
            echo "<form method='post' action='combie.php'>
                    <input type='submit' value='Nächstes Rätsel' class='ctf-button'>
                  </form>";
      } else {
            echo "<h1>Login fehlgeschlagen :( </h1>";
     }
   ?>

    </div>
    
</body>
</html>
