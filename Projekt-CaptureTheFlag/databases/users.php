<?php

    $servername = "localhost";
    $username = "root";
    $passwort = "";

    //Verbindung zum DB-Server herstellen
    $conn = new mysqli($servername, $username, $passwort);

    if($conn->connect_error) {
        die("Verbindung fehlgeschlagen: ". $conn->connect_error); //Exit + Fehlermeldung
    }

    //Datenbank erstellen
    $sql = "CREATE DATABASE IF NOT EXISTS ctf";

    // Datenbank auswählen
    $conn->select_db("ctf");

    $sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(50)
    )";

    $conn->query($sql);

 //Testnutzer, die benötigt werden, um SQLi durchzuführen. 
 $result = $conn->query("SELECT COUNT(*) as count FROM users");
 $row = $result->fetch_assoc();
  if ($row['count'] == 0) {
    $sql = "INSERT INTO users (username, password)
    VALUES 
    ('admin', 'geheim'),
    ('hacker', '1234'),
    ('gast', 'passwort')";
    $conn->query($sql);
}
    ?>