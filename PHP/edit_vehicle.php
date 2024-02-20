<?php


include 'db.php'; 

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'employee' && $_SESSION['role'] !== 'admin')) {
    header('Location: admin_login.php'); 
    exit;
}

$vehicle_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($vehicle_id <= 0) {
    die('ID de véhicule invalide.');
}


if ($stmt = $conn->prepare("SELECT * FROM vehicles WHERE id = ?")) {
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
?>
<?php
include 'db.php'; 


$vehicle_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($vehicle_id <= 0) {
    die('ID de véhicule invalide.');
}


if ($stmt = $conn->prepare("SELECT * FROM vehicles WHERE id = ?")) {
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
?>
