 <?php
    session_start();
    $anagrams = ["Computer Science"=>"eCcentric me Soup", "Algorithm"=>"logArithm", "Artificial Intelligence"=>"A critIcal lifeline tinge", "Database"=>"a baD east","Website"=>"bite seW", "Sourcecode"=>"eco cueS rod", "Hypertext"=>"Hex pet try", "Protocol"=>"color toP", "Programming"=>"gaming mr Pro"];

    //Prüfe, ob das Formular zum ersten Mal aufgerufen wird. Wenn ja: wähle 5 zufällige Wörter aus der Liste. Wenn nein: gewählte Wörter+Lösung werden encoded und versteckt mitgeschickt 
    if(!isset($_POST['anagrams'])) {  
        $chosen = [];
        foreach ($anagrams as $solution => $anagram) {
            $chosen[] = ["solution"=>$solution, "anagrams"=>$anagram];
        }
        shuffle($chosen);
        $chosen = array_slice($chosen, 0, 5);
    } else {
        $chosen = json_decode($_POST['anagrams'], true);
    }
    
    //Prüfe, ob Formular abgesendet wurde.Vergleiche Nutzereingaben mit korrekter Lösung. Groß-und Kleinschreibung ist hierbei unwichtig.
    $results = [];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        foreach ($_POST['answer'] as $index => $answer) {
            $correct = strtolower($chosen[$index]['solution']);
            $useranswer = strtolower(trim($answer));
            $results[$index] = ($correct === $useranswer);
            
        }
    }

    $allCorrect = !empty($results) && !in_array(false, $results, true);

    $modalContent = "
                <h2>Hinweis zu Anagrammen</h2>
                <ul>
                    <li>Jedes dieser Wörter hat etwas mit der Informatik zu tun.</li><br>
                    <li>Die Anzahl der Großbuchstaben verrät etwas über die Anzahl der Lösungswörter.</li><br>
                    <li>Benutze englische Wörter!</li>
                </ul>
                ";

    include '../modal.php'; // Modal für Hinweise einbinden
    ?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTF: Anagramme</title>
    <link rel="stylesheet" href="../assets/style/style.css?v=126">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Press+Start+2P">
    

</head>
<body class="scrollable">
 <!--div class="layout"-->
    <div class="ctf-container">
     <h1>Rätsel 1: Anagramme</h1>
        <span>
            <button class="ctf-button" onclick="openModal()">Hinweise anzeigen</button>
        </span>
     <p>Anagramme sind Wörter oder Sätze, die so umgestellt werden können, dass daraus neue Wörter oder Sätze entstehen.</p>
     <h2 id="anagramm-header">Löse die folgenden Anagramme: </h2>

     <form method="post" action="">
        <?php
            foreach($chosen as $index => $item): ?>
         <div class="question">
            <label>
                <br><p class="anagramm">Anagramm:</p> <strong><?= htmlspecialchars($item['anagrams']) ?></strong><br>
                Deine Lösung:
                <input type="text" name="answer[<?= $index ?>]" value="<?= isset($_POST['answer'][$index]) ? htmlspecialchars($_POST['answer'][$index]) : '' ?>">
            </label>

            <?php if (isset($results[$index])): ?>
                <?php if ($results[$index]): ?>
                    <span class="correct"> Richtig!</span>
                <?php else: ?>
                    <span class="wrong"> Falsch! </span>
                <?php endif; ?>
            <?php endif; ?>
        </div>
     <?php endforeach; ?>

     <!-- Anagramm-Daten als verstecktes Feld -->
     <input type="hidden" name="anagrams" value='<?= json_encode($chosen) ?>'><br>

     <button type="submit" class="ctf-button">Antworten prüfen</button>

        
     </form>
    <!-- Erst wenn alle Anagramme gelöst wurden, erscheint der Button zum nächsten Rätsel-->
     <?php if ($allCorrect): ?>
     <form action="encryption.php" method="post">
        <input type="hidden" name="teilflag_ana" value="1">
        <button type="submit" id="continue-button">Nächstes Rätsel</button>
      </form>
     <?php endif; ?>


 </div>
    <!--/div-->
</body>
</html>