<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Étudiant</title>
</head>
<body>
    <h2>Ajouter Étudiant</h2>

    <form action="" method="post">
        <label>Nom</label>
        <input type="text" name="nom" required><br>

        <label>Prénom</label>
        <input type="text" name="prenom" required><br>

        <label>Téléphone</label>
        <input type="text" name="telephone" required><br>

        <label>Adresse</label>
        <input type="text" name="adresse" required><br>

        <label>Mot de passe</label>
        <input type="password" name="password" required><br>

        <button type="submit">Ajouter étudiants</button>

    </form>
    <form action="afficher.php" method="POST">
        <button type="submit">afficher</button>
    </form>

    <form action="action_prof.php" method="POST">
        <button type="submit">Retour</button>
    </form>
</body>
</html>
<?php
session_start();
$hostname = "localhost";
$universite = "root";
$password = "";
$dbname = "gestion_etudiants";

try {
    $mysqli = new mysqli($hostname, $universite, $password, $dbname);

    // Vérifier la connexion
    if ($mysqli->connect_error) {
        die("Erreur lors de la connexion à la base de données : " . $mysqli->connect_error);
    }

    // Récupérer les données du formulaire
    $nom = isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : null;
    $prenom = isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : null;
    $telephone = isset($_POST['telephone']) ? htmlspecialchars($_POST['telephone']) : null;
    $adresse = isset($_POST['adresse']) ? htmlspecialchars($_POST['adresse']) : null;
    $password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : null;

    // Vérifier si les données sont présentes
    if ($nom !== null && $prenom !== null && $telephone !== null && $adresse !== null && $password !== null) {
        // Requête SQL pour ajouter un étudiant
        $query = "INSERT INTO universite (nom, prenom, telephone, adresse, password) VALUES (?, ?, ?, ?, ?)";

        // Préparer la requête
        $requete = $mysqli->prepare($query);

        // Binder les paramètres
        $requete->bind_param('sssss', $nom, $prenom, $telephone, $adresse, $password);

        // Exécuter la requête
        if ($requete->execute()) {
            echo "Étudiant ajouté avec succès!";
           
        } else {
            echo "Erreur lors de l'ajout : " . $requete->error;
        }

        // Fermer la requête
        $requete->close();
    }
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
} finally {
    // Fermer la connexion
    if ($mysqli) {
        $mysqli->close();
    }
}
?>
