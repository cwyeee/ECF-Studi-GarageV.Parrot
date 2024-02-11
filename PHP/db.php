<?php
$servername = "localhost";
$username = "root"; // Le nom d'utilisateur par défaut de XAMPP pour MySQL
$password = ""; // Par défaut, il n'y a pas de mot de passe dans XAMPP
$dbname = "garage";

// Tenter de se connecter à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion: " . $conn->connect_error);
}
?>
