<?php

    $servername = "localhost";
    $username = "root";
    $passwort = "";

    //Verbindung zum DB-Server herstellen
    $conn = new mysqli($servername, $username, $passwort);

    if($conn->connect_error) {
        die("Verbindung fehlgeschlagen: ". $conn->connect_error); //Exit + Fehlermeldung
    }
    // zum Testen
    /*echo "Verbindung erfolgreich<br>";*/

    //Datenbank erstellen
    $sql = "CREATE DATABASE IF NOT EXISTS injection_users";
    /*if($conn->query($sql) === TRUE) {
        echo "Datenbank wurde erfolgreich erstellt<br>";
    } else {
        echo "Fehler beim Erstellen der Datenbank". $conn->error;
    }*/

    // Datenbank auswählen
    $conn->select_db("injection_users");

    $sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(50)
    )";
 
    

    // Check, ob Tabelle richtig erstellt wurde
   /* if($conn->query($sql) === TRUE) {
        echo "Tabelle: wurde erstellt <br>";
    } else {
        echo "Fehler beim Erstellen der Tabelle". $conn->error;
    }*/

 $result = $conn->query("SELECT COUNT(*) as count FROM users");
 $row = $result->fetch_assoc();
  if ($row['count'] == 0) {
    $sql = "INSERT INTO users (username, password)
    VALUES 
    ('admin', 'geheim'),
    ('hacker', '1234'),
    ('gast', 'passwort')";
    echo "Nutzer erstellt";
  /*if ($conn->query($sql) === TRUE) {
        echo "Nutzer wurden eingefügt.<br>";
    } else {
        echo "Fehler beim Einfügen der Nutzer: " . $conn->error;
    }
} else {
    echo "Nutzer schon vorhanden.<br>";*/
}
    ?>