<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    
</head>
<body>
    <?php
session_start();

    // Vérifier si l'utilisateur est authentifié
    if (isset($_SESSION['nom'])) {
        $nom = $_SESSION['nom'];

        // Affichage de la liste des utilisateurs
        $hostname = "localhost";
        $universite = "root";
        $password = "";
        $dbname = "gestion_etudiants";

        $connexion = mysqli_connect($hostname, $universite, $password, $dbname);

        if (!$connexion) {
            die("La connexion a échoué : " . mysqli_connect_error());
        }

        $query = "SELECT id, nom, prenom, telephone, adresse FROM universite";
        $result = mysqli_query($connexion, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            echo "<h3>Liste des etudiants :</h3>";
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>telephone</th>
                        <th>adresse</th>
                    </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nom']}</td>
                        <td>{$row['prenom']}</td>
                        <td>{$row['telephone']}</td>
                        <td>{$row['adresse']}</td>
                      </tr>";
            }

            echo "</table>";
        } else {
            echo "Aucun utilisateur trouvé.";
        }

        // Fermer la connexion
        mysqli_close($connexion);

    } else {
        echo "Vous n'êtes pas authentifié. Veuillez vous connecter.";
    }
    ?>
        <form action="connexion.php" method="post">
        <button type="submit">Retour sur la precedente </button>
    </form>
    <form action="action_prof.php" method="post">
        <button type="submit">aller sur la page action professeur</button>
    </form>
</body>
</html>
