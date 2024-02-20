<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Employé</title>
    <link rel="stylesheet" href="/../css/Style-2.css"> 
</head>
<body>
    <h2>Ajouter un Nouvel Employé</h2>
    <form action="admin_add_employee.php" method="post">
        <div class="form-group">
            <label for="name">Nom d'utilisateur :</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <input type="submit" value="Ajouter l'Employé">
        </div>
    </form>

<?php
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'employee' && $_SESSION['role'] !== 'admin')) {
    header('Location: admin_login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db.php'; 

    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $role = "employee"; 

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ssss", $name, $email, $passwordHash, $role);
        if ($stmt->execute()) {
            echo "Nouvel employé ajouté avec succès.";
        } else {
            echo "Erreur : " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Erreur de préparation : " . $conn->error;
    }

    $conn->close();
}
?>
</body>
</html>
