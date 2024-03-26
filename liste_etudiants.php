<?php
include('connexion.php');
session_start();

if (!isset($_SESSION['utilisateur_id']) || $_SESSION['role'] !== 'professeur') {
    header("Location: connexion.php");
    exit();
}

$requete = "SELECT * FROM universite";
$resultat = $connexion->query($requete);

if ($resultat->num_rows > 0) {
    echo "<h2>Liste des étudiants</h2>";
    echo "<ul>";

    while ($etudiant = $resultat->fetch_assoc()) {
        echo "<li>{$etudiant['autre_champ']} - <a href='modifier_etudiant.php?id={$etudiant['id']}'>Modifier</a> | <a href='supprimer_etudiant.php?id={$etudiant['id']}'>Supprimer</a></li>";
    }

    echo "</ul>";
} else {
    echo "Aucun étudiant trouvé.";
}

$connexion->close();
?>
