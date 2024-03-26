<?php
session_start();

include('conn.php');

// Si le formulaire est soumis pour mettre à jour les détails
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $nom = isset($_POST['nom']) ? $_POST['nom'] : null;
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : null;
    $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : null;
    $adresse = isset($_POST['adresse']) ? $_POST['adresse'] : null;

    // Vérifier si toutes les données nécessaires sont présentes
    if ($id !== null && $nom !== null && $prenom !== null && $telephone !== null && $adresse !== null) {
        // Requête SQL pour mettre à jour les détails de l'étudiant
        $requete_update = "UPDATE universite SET nom=?, prenom=?, telephone=?, adresse=? WHERE id=?";

        // Préparer la requête
        $stmt = $connexion->prepare($requete_update);

        // Binder les paramètres
        $stmt->bind_param('ssssi', $nom, $prenom, $telephone, $adresse, $id);

        // Exécuter la requête de mise à jour
        if ($stmt->execute()) {
            echo "Détails de l'étudiant mis à jour avec succès!";
        } else {
            echo "Erreur lors de la mise à jour des détails de l'étudiant : " . $stmt->error;
        }

        // Fermer la requête
        $stmt->close();
    } else {
        echo "Données manquantes pour la mise à jour.";
    }
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
    <title>Modifier Détails Étudiant</title>
</head>
<body>
    <h2>Modifier Détails Étudiant</h2>

    <form action="" method="post">
        <label>Sélectionner un étudiant</label>
        <select name="id" required>
            <?php
            // Afficher la liste déroulante des étudiants
            while ($etudiant = $resultat_select_tous->fetch_assoc()) {
                echo "<option value='{$etudiant['id']}'>{$etudiant['nom']} {$etudiant['prenom']}</option>";
            }
            ?>
        </select><br>

        <?php
        // Pré-remplir les champs avec les valeurs actuelles de l'étudiant sélectionné
        if (isset($_POST['id'])) {
            $id_selectionne = $_POST['id'];
            $requete_select_etudiant = "SELECT * FROM universite WHERE id=?";
            
            // Préparer la requête
            $stmt_select_etudiant = $connexion->prepare($requete_select_etudiant);
            
            // Binder les paramètres
            $stmt_select_etudiant->bind_param('i', $id_selectionne);

            // Exécuter la requête
            $stmt_select_etudiant->execute();

            // Récupérer le résultat
            $resultat_select_etudiant = $stmt_select_etudiant->get_result();

            if ($resultat_select_etudiant->num_rows > 0) {
                $etudiant_selectionne = $resultat_select_etudiant->fetch_assoc();
                echo "<label>Nom</label><input type='text' name='nom' value='{$etudiant_selectionne['nom']}' required><br>";
                echo "<label>Prénom</label><input type='text' name='prenom' value='{$etudiant_selectionne['prenom']}' required><br>";
                echo "<label>Téléphone</label><input type='text' name='telephone' value='{$etudiant_selectionne['telephone']}' required><br>";
                echo "<label>Adresse</label><input type='text' name='adresse' value='{$etudiant_selectionne['adresse']}' required><br>";
            }

            // Fermer la requête
            $stmt_select_etudiant->close();
        }
        ?>

        <button type="submit">Mettre à jour Détails Étudiant</button>
    </form>
     
    <form action="afficher.php" method="post">
        <button type="submit">Afficher</button>
    </form>
    <form action="action_prof.php" method="post">
        <button type="submit">Retour</button>
    </form>
</body>
</html>
