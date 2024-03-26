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
