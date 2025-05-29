<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTF: XSS</title>
</head>
<body>
    <h1> Rätsel x: XSS </h1>
    <p>In diesem Rätsel musst du eine Sicherheitslücke ausnutzen, um ein Alert-Skript auszuführen</p>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>"></form>
</body>
</html>