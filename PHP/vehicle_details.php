<?php
include 'db.php';

$vehicle_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($vehicle_id <= 0) {
    die('ID de véhicule invalide.');
}

$query = "SELECT * FROM vehicles WHERE id = ?";
if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("i", $vehicle_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($vehicle = $result->fetch_assoc()) {
        
    } else {
        die('Véhicule non trouvé.');
    }
    
    $stmt->close();
} else {
    die("Erreur de préparation : " . $conn->error);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du Véhicule</title>
    <!-- Lien vers CSS ici si nécessaire -->
</head>
<body>
    <h1>Détails du Véhicule</h1>
    <div>
        <p>Marque: <?php echo htmlspecialchars($vehicle['make']); ?></p>
        <p>Modèle: <?php echo htmlspecialchars($vehicle['model']); ?></p>
        <p>Année: <?php echo htmlspecialchars($vehicle['year']); ?></p>
        <p>Kilométrage: <?php echo htmlspecialchars($vehicle['mileage']); ?> km</p>
        <p>Prix: <?php echo htmlspecialchars($vehicle['price']); ?> €</p>
        <!-- Inclure ici plus de détails et potentiellement des images si disponibles -->
    </div>
</body>
</html>
