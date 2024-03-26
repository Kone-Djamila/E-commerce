<?php
session_start();

include('conn.php');

// Vérifier si le formulaire de connexion est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si les clés existent dans $_POST
    $nom = isset($_POST['nom']) ? $_POST['nom'] : null;
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    // Vérifier si toutes les données nécessaires sont présentes
    if ($nom !== null && $prenom !== null && $password !== null) {
        // Requête SQL pour vérifier les informations d'identification du professeur
        $requete_connexion = "SELECT id, nom, prenom FROM prof WHERE nom=? AND prenom=? AND password=?";

        // Préparer la requête
        $stmt = $connexion->prepare($requete_connexion);

        // Binder les paramètres
        $stmt->bind_param('sss', $nom, $prenom, $password);

        // Exécuter la requête
        $stmt->execute();

        // Récupérer le résultat
        $resultat = $stmt->get_result();

        // Vérifier si les informations d'identification sont correctes
        if ($resultat->num_rows > 0) {
            // Professeur authentifié, enregistrer les informations dans la session
            $professeur = $resultat->fetch_assoc();
            $_SESSION['id'] = $professeur['id'];
            $_SESSION['nom'] = $professeur['nom'];
            $_SESSION['prenom'] = $professeur['prenom'];

            // Rediriger vers la page d'accueil ou autre
            header("Location: action_prof.php");
            exit();
        } else {
            echo "Identifiants incorrects.";
        }

        // Fermer la requête
        $stmt->close();
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONNEXION</title>
</head>
<body>
    <form action="" method="post">
      <h2>CONNEXION</h2>
      
      <label>nom</label>
      <input type="text" name="nom" placeholder="nom" required><br>

      <label>prenom</label>
      <input type="text" name="prenom" placeholder="prenom" required><br>

      <label>password</label>
      <input type="password" name="password" placeholder="password" required><br>

      <button type="submit">Se connecter</button>
    </form>       
</body>
</html>
