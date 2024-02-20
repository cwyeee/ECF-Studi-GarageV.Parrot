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

if ($stmt = $conn->prepare("DELETE FROM vehicles WHERE id = ?")) {
    $stmt->bind_param("i", $vehicle_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $message = "Véhicule supprimé avec succès.";
    } else {
        $message = "Erreur lors de la suppression du véhicule. Peut-être que l'ID spécifié n'existe pas.";
    }

    $stmt->close();
} else {
    die("Erreur de préparation de la requête : " . $conn->error);
}

$conn->close();

session_start();
$_SESSION['message'] = $message;

header("Location: list_vehicles.php");
exit;
?>
