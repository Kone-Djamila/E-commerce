<?php
$hostname = "localhost";
$universite = "root";
$password = "";
$dbname="gestion_etudiants";

// Établir la connexion
$connexion = mysqli_connect($hostname, "root", "", $dbname);

// Vérifier la connexion
if (!$connexion) {
    die("La connexion a échoué : " . mysqli_connect_error());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSCRIPTION</title>
</head>
<body>
    <form action="" method="post">
      <h2>INSCRIPTION_PROFESSEUR</h2>
      
      <label>nom</label>
      <input type="text" name="nom" id="nom" placeholder="nom"><br>

      <label>prenom</label>
      <input type="text" name="prenom" id="prenom" placeholder="prenom"><br>
    
      <label>email</label>
      <input type="text" name="email" id="email" placeholder="email"><br>
    
      <label>telephone</label>
      <input type="text" name="telephone" id="telephone" placeholder="telephone"><br>

      <label>adresse</label>
      <input type="text" name="adresse" id="adresse" placeholder="adresse"><br>
     
      <label>matiere</label>
      <input type="text" name="matiere" id="matiere" placeholder="matiere"><br>
    
      <label>password</label>
      <input type="password" name="password" id="password" placeholder="password"><br>

      <button type="submit">S'inscrire</button>
    </form>
     <!-- Bouton de connexion -->
     <form action="connexionP.php" method="post">
        <button type="submit">Se connecter</button>
    </form>  
    <form action="profil.php" method="POST">
        <button type="submit">retour</button>
    </form>
</body>
<?php   
        if (isset($_POST["nom"])){

            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $email = $_POST["email"];
            $telephone = $_POST["telephone"];
            $adresse = $_POST["adresse"];
            $matiere = $_POST["matiere"];
            $mot_de_passe_hache = $_POST["password"];

            $stmt = $connexion->prepare("INSERT INTO prof (nom, prenom, email, telephone, adresse, matiere, password) VALUES (?,?,?,?,?,?,?)");
            if ($stmt) {
                
                // Liage des paramètres
                $stmt->bind_param("sssssss", $nom, $prenom, $email, $telephone, $adresse, $matiere, $mot_de_passe_hache);

                // Exécution de la requête
                if ($stmt->execute()) {
                    echo "Inscription réussie pour $nom $prenom $email $telephone $adresse $matiere $mot_de_passe_hache.";
                } else {
                    echo "Erreur d'insertion dans la base de données : " . $stmt->error;
                }

                // Fermer le statement
                $stmt->close();
            } else {
                echo "Erreur de préparation de la requête : " . $connexion->error;
            }
        }
?>
</html>
