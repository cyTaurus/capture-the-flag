<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    test
      <form method="post" action="challenge2.php">
        <input type="hidden" name="action" value="start">

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required maxlength="30">
        <br><br>
        <button type="submit" id="start">weiter</button>
    </form>
</body>
</html>