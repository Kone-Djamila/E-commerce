<?php
session_start();

include('conn.php');

// Si le formulaire est soumis pour supprimer un étudiant
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Requête SQL pour supprimer l'étudiant
    $requete_supprimer = "DELETE FROM universite WHERE id=?";

    // Préparer la requête
    $stmt = $connexion->prepare($requete_supprimer);

    // Binder les paramètres
    $stmt->bind_param('i', $id);

    // Exécuter la requête de suppression
    if ($stmt->execute()) {
        echo "Étudiant supprimé avec succès!";
    } else {
        echo "Erreur lors de la suppression de l'étudiant : " . $stmt->error;
    }

    // Fermer la requête
    $stmt->close();
}

// Sélectionner tous les étudiants
$requete_select_tous = "SELECT * FROM universite";
$resultat_select_tous = $connexion->query($requete_select_tous);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer Étudiant</title>
</head>
<body>
    <h2>Supprimer Étudiant</h2>

    <form action="" method="post">
        <label>Sélectionner un étudiant à supprimer</label>
        <select name="id" required>
            <?php
            // Afficher la liste déroulante des étudiants
            while ($etudiant = $resultat_select_tous->fetch_assoc()) {
                echo "<option value='{$etudiant['id']}'>{$etudiant['nom']} {$etudiant['prenom']}</option>";
            }
            ?>
        </select><br>

        <button type="submit">Supprimer Étudiant</button>
    </form>
    <form action="afficher.php" method="post">
        <button type="submit">Afficher</button>
    </form>
    <form action="action_prof.php" method="post">
        <button type="submit">Retour</button>
    </form>
</body>
</html>
