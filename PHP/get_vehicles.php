<?php
include 'db.php'; // Inclure le fichier de connexion

$sql = "SELECT * FROM Vehicles"; // Une requête SQL pour obtenir toutes les voitures
$result = $conn->query($sql); // Exécution de la requête

if ($result->num_rows > 0) {
    // Affichage des données de chaque voiture
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Marque: " . $row["make"]. " - Modèle: " . $row["model"]. "<br>";
    }
} else {
    echo "0 résultats";
}
$conn->close(); // Fermer la connexion
?>
