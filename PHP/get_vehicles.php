<?php
<<<<<<< HEAD
include 'db.php'; 

$sql = "SELECT * FROM Vehicles"; 
$result = $conn->query($sql); 

if ($result->num_rows > 0) {
    
=======
include 'db.php'; // Inclure le fichier de connexion

$sql = "SELECT * FROM Vehicles"; // Une requête SQL pour obtenir toutes les voitures
$result = $conn->query($sql); // Exécution de la requête

if ($result->num_rows > 0) {
    // Affichage des données de chaque voiture
>>>>>>> d363c38 (Ajout de la page nos servics, ajout de bootstrap dans le code)
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Marque: " . $row["make"]. " - Modèle: " . $row["model"]. "<br>";
    }
} else {
    echo "0 résultats";
}
<<<<<<< HEAD
$conn->close(); 
=======
$conn->close(); // Fermer la connexion
>>>>>>> d363c38 (Ajout de la page nos servics, ajout de bootstrap dans le code)
?>
