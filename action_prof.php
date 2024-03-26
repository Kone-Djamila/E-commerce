<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actions Professeur</title>
</head>
<body>
    <h2>Actions Professeur</h2>

    <form action="afficher.php" method="get">
        <button type="submit">Afficher</button>
    </form>

    <form action="ajouter_etudiant.php" method="get">
        <button type="submit">Ajouter</button>
    </form>

    <form action="modifierE.php" method="get">
        <button type="submit">Modifier</button>
    </form>

    <form action="supprimer.php" method="get">
        <button type="submit">Supprimer</button>
    </form>

</body>
</html>
