 <?php
    $anagrams = ["Computer Science"=>"Eccentric Me Soup", "Algorithm"=>"Logarithm", "Artificial Intelligence"=>"A Critical Lifeline Tinge", "Database"=>"A Bad East","Website"=>"Bite Sew", "Sourcecode"=>"Eco Cues Rod", "Hypertext"=>"Hex Pet Try", "Protocol"=>"Color Top", "Programming"=>"Gaming Mr Pro"];

    if(!isset($_POST['anagrams'])) { 
        $random_anagrams = array_rand($anagrams, 5); 
        $chosen = [];
        foreach ($random_anagrams as $key) {
            $chosen[] = ["solution"=>$key, "anagrams"=>$anagrams[$key]];
        }
    } else {
        $chosen = json_decode($_POST['anagrams'], true);
    }
    
    $results = [];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        foreach ($_POST['answer'] as $index => $answer) {
            $correct = strtolower($chosen[$index]['solution']);
            $useranswer = strtolower(trim($answer));
            $results[$index] = ($correct === $useranswer);
            
        }
    }

    $allCorrect = !empty($results) && !in_array(false, $results, true);

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTF: Anagramme</title>
    <link rel="stylesheet" href="../assets/style/style.css?v=126">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Press+Start+2P">
    

</head>
<body>
 <!--div class="layout"-->
    <div class="ctf-container">
     <h1>Rätsel 1: Anagramme</h1>
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

     <!-- Anagramm-Daten als verstecktes Feld erhalten -->
     <input type="hidden" name="anagrams" value='<?= json_encode($chosen) ?>'><br>

     <button type="submit" class="ctf-button">Antworten prüfen</button>

        
     </form>

     <?php if ($allCorrect): ?>
     <form action="encryption.php" method="post">
        <button type="submit" id="continue-button">Nächstes Rätsel</button>
      </form>
     <?php endif; ?>


 </div>
    <!--/div-->
</body>
</html>