<?php
include 'db.php';

$vehicle_id = $_POST['id'];
$make = $_POST['make'];
$model = $_POST['model'];
$year = $_POST['year'];
$mileage = $_POST['mileage'];
$price = $_POST['price'];

if ($stmt = $conn->prepare("UPDATE vehicles SET make = ?, model = ?, year = ?, mileage = ?, price = ? WHERE id = ?")) {
    $stmt->bind_param("ssiiii", $make, $model, $year, $mileage, $price, $vehicle_id);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        echo "Modifications enregistrées avec succès.";
    } else {
        echo "Aucune modification enregistrée ou erreur.";
    }
    
    $stmt->close();
} else {
    die("Erreur de préparation : " . $conn->error);
}

$conn->close();
?>
