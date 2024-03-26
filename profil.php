<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qui etês vous?</title>
</head>
<body>
    <h2>Qui etês vous?</h2>

    <form action="inscription_E.php" method="POST">
        <button type="submit">ETUDIANTS</button>
    </form>

    <form action="inscription_P.php" method="POST">
        <button type="submit">PROFESSEURS</button>
    </form>
    
</body>
</html>