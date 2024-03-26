<?php
session_start();

include('conn.php');

// Vérifier si l'étudiant est connecté
if (!isset($_SESSION['id'])) {
    header("Location: connexion.php"); // Rediriger vers la page de connexion s'il n'est pas connecté
    exit();
}

$id = $_SESSION['id'];

// Récupérer les informations actuelles de l'étudiant
$requete_select_etudiant = "SELECT * FROM universite WHERE id=?";
$stmt_select_etudiant = $connexion->prepare($requete_select_etudiant);
$stmt_select_etudiant->bind_param('i', $id);
$stmt_select_etudiant->execute();
$resultat_select_etudiant = $stmt_select_etudiant->get_result();

if ($resultat_select_etudiant->num_rows > 0) {
    $etudiant = $resultat_select_etudiant->fetch_assoc();
} 

// Si le formulaire est soumis pour mettre à jour les détails
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = isset($_POST['nom']) ? $_POST['nom'] : $etudiant['nom'];
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : $etudiant['prenom'];
    $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : $etudiant['telephone'];
    $adresse = isset($_POST['adresse']) ? $_POST['adresse'] : $etudiant['adresse'];

    // Requête SQL pour mettre à jour les détails de l'étudiant
    $requete_update = "UPDATE universite SET nom=?, prenom=?, telephone=?, adresse=? WHERE id=?";

    // Préparer la requête
    $stmt_update = $connexion->prepare($requete_update);

    // Binder les paramètres
    $stmt_update->bind_param('ssssi', $nom, $prenom, $telephone, $adresse, $id);

    // Exécuter la requête de mise à jour
    if ($stmt_update->execute()) {
        echo "Détails de l'étudiant mis à jour avec succès!";
        $etudiant['nom'] = $nom;
        $etudiant['prenom'] = $prenom;
        $etudiant['telephone'] = $telephone;
        $etudiant['adresse'] = $adresse;
    } else {
        echo "Erreur lors de la mise à jour des détails de l'étudiant : " . $stmt_update->error;
    }

    // Fermer la requête
    $stmt_update->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mettre à jour Détails Étudiant</title>
</head>
<body>
    <h2>Mettre à jour Détails Étudiant</h2>

    <form action="" method="post">
        <label>Nom</label>
        <input type="text" name="nom" value="<?php echo $etudiant['nom']; ?>" required><br>

        <label>Prénom</label>
        <input type="text" name="prenom" value="<?php echo $etudiant['prenom']; ?>" required><br>

        <label>Téléphone</label>
        <input type="text" name="telephone" value="<?php echo $etudiant['telephone']; ?>" required><br>

        <label>Adresse</label>
        <input type="text" name="adresse" value="<?php echo $etudiant['adresse']; ?>" required><br>

        <button type="submit">Mettre à jour Détails Étudiant</button>
    </form>

    <form action="logout.php" method="post">
        <button type="submit">Déconnexion</button>
    </form>
</body>
</html>