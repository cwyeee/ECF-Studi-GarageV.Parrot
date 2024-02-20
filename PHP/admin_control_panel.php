<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['auth_token'])) {
        include 'db.php';
        $token = $_COOKIE['auth_token'];
        $query = "SELECT id, name, email, role FROM users WHERE auth_token = ?";
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("s", $token);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($user = $result->fetch_assoc()) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['role'] = $user['role'];
            }
            $stmt->close();
        }
        $conn->close();
    }
}

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'employee' && $_SESSION['role'] !== 'admin')) {
    header('Location: admin_login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panneau de Contrôle Employé</title>
    <link rel="stylesheet" href="/../css/Style-2.css">
    <style>
        .options a {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            margin: 10px;
            border-radius: 5px;
            text-decoration: none;
        }

        .options a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Bienvenue dans votre Panneau de Contrôle</h1>
    <div class="options">
        <a href="add_vehicle.php">Ajouter un véhicule</a>
        <a href="list_vehicles.php">Gérer les véhicules</a>
        <a href="view_reviews.php">Voir les avis</a>
        <a href="view_forms.php">Consulter les formulaires clients</a>
    </div>
</body>
</html>
