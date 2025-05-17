<?php
    session_start(); // Session starten um Username speichern zu können

    $servername = "localhost";
    $username = "root";
    $passwort = "";

    //Verbindung zum DB-Server herstellen
    $conn = new mysqli($servername, $username, $passwort);

    if($conn->connect_error) {
        die("Verbindung fehlgeschlagen: ". $conn->connect_error); //Exit + Fehlermeldung
    }
    // zum Testen
    echo "Verbindung erfolgreich<br>";

    //Datenbank erstellen
    $sql = "CREATE DATABASE IF NOT EXISTS ctf";
    if($conn->query($sql) === TRUE) {
        echo "Datenbank wurde erfolgreich erstellt<br>";
    } else {
        echo "Fehler beim Erstellen der Datenbank". $conn->error;
    }

    // Datenbank auswählen
    $conn->select_db("ctf");

    // Tabelle für die Zeiten für das Leaderboard erstellen
    $sql = "CREATE TABLE IF NOT EXISTS Zeiten(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    start_zeit TIMESTAMP NULL,
    end_zeit TIMESTAMP NULL,
    dauer INT
    )";
    // Check, ob Tabelle richtig erstellt wurde
    if($conn->query($sql) === TRUE) {
        echo "Tabelle: Zeiten wurde erfolgreich erstellt<br>";
    } else {
        echo "Fehler beim Erstellen der Tabelle". $conn->error;
    }

    // Datensatz hinzufügen wenn Rätsel gestartet wird
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "start") {
        $username = $_POST['username'];
        $_SESSION['username'] = $username; // Username in Session speichern

        $sql = "INSERT INTO Zeiten (username, start_zeit, end_zeit)
        VALUES('$username', CURRENT_TIME, NULL)";

        if($conn->query($sql) === TRUE) {
            // Nach erfolgreichen Start User auf ziel.php weiterleiten
            header("Location: challenges/anagramms.php");
        } else {
            echo "Fehler beim Einfügen des Datensatzes." . $conn->error;
        }
    }

    // Datensatz mit Endzeit aktualisieren
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "ende") {
        if(isset($_SESSION['username'])) {
            $username = $_SESSION['username'];

            $sql = "UPDATE Zeiten 
                    SET end_zeit = CURRENT_TIME,
                        dauer = TIMESTAMPDIFF(SECOND, start_zeit, CURRENT_TIME)
                    WHERE username = '$username' AND end_zeit IS NULL";
            if($conn->query($sql) === TRUE) {
                echo "Endzeitpunkt und Dauer erfolgreich gesetzt<br>";
            } else {
                echo "Fehler beim Aktualisieren der Endzeit". $conn->error;
            }
        } else {
            echo "Kein User angemeldet";
        }
    }

    // Anzeige Leaderboard
    $leaderboardHtml = ""; // Variable für die Tabelle initialisieren, damit diese in index.php verwendet werden kann
    $sql = "SELECT username, SEC_TO_TIME(dauer) AS dauer
            FROM Zeiten
            ORDER BY dauer ASC";
    $leaderboard = $conn->query($sql);

    if($leaderboard->num_rows > 0) {
        $leaderboardHtml .= "
        <table class='leaderboard'>
        <tr>
        <th class='tableHeader'>Platzierung</th> <th class='tableHeader'>Username</th> <th class='tableHeader'>Dauer</th>
        </tr>
        ";

        $platzierung = 1;
        while($row = $leaderboard->fetch_assoc()) {
            $leaderboardHtml .= "
            <tr>
            <td>".$platzierung."</td>
            <td>".$row["username"]."</td> 
            <td>".$row["dauer"]."</td>
            </tr>";
            $platzierung++;
        }
        $leaderboardHtml .= "</table>";

    } else {
        $leaderboardHtml .= "Noch keine Ergebnisse vorhanden";
    }
    
    // Verbindung zu Datenbank schließen
    $conn->close();