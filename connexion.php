<?php
$hostname = "localhost";
$universite = "root";
$password = "";
$dbname = "gestion_etudiants";

// Établir la connexion
$connexion = mysqli_connect($hostname, $universite, $password, $dbname);

// Vérifier la connexion
if (!$connexion) {
    die("La connexion a échoué : " . mysqli_connect_error());
}

// Vérifier si le formulaire de connexion est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = isset($_POST['nom']) ? $_POST['nom'] : null;
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;


    // Vérifier les informations de connexion dans la base de données
    $query = "SELECT * FROM universite WHERE nom = '$nom' AND prenom = '$prenom' AND password = '$password'";
    $result = mysqli_query($connexion, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        session_start();
    $_SESSION['nom'] = $nom;
    echo("connexion reussite");
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
    <form action="afficher.php" method="post">
      <h2>CONNEXION</h2>
      
      <label>nom</label>
      <input type="text" name="nom" id="nom" placeholder="nom"><br>

      <label>prenom</label>
      <input type="text" name="prenom" id="prenom" placeholder="prenom"><br>
    
      <label>password</label>
      <input type="password" name="password" id="password" placeholder="password"><br>

        <button type="submit">Se connecter</button>
    </form>       
</body>
</html>
