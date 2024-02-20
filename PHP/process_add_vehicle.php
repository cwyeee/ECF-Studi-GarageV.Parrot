<?php
include 'db.php';

$message = '';

session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'employee' && $_SESSION['role'] !== 'admin')) {
    header('Location: admin_login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $make = $conn->real_escape_string($_POST['make']);
    $model = $conn->real_escape_string($_POST['model']);
    $year = $conn->real_escape_string($_POST['year']);
    $mileage = $conn->real_escape_string($_POST['mileage']);
    $price = $conn->real_escape_string($_POST['price']);
    $user_id = 1;

    $uploadDirectory = '';

    if (isset($_FILES['vehicleImage']) && $_FILES['vehicleImage']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $fileName = $_FILES['vehicleImage']['name'];
        $fileTmpName = $_FILES['vehicleImage']['tmp_name'];
        $fileExtension = strtolower(end(explode('.', $fileName)));

        if (in_array($fileExtension, $allowed)) {
            $newFileName = uniqid('vehicle_', true) . '.' . $fileExtension;
            $uploadDirectory = 'uploads/' . $newFileName;

            if (move_uploaded_file($fileTmpName, $uploadDirectory)) {

            } else {
                $message = "Il y a eu une erreur lors du téléchargement de votre fichier.";
            }
        } else {
            $message = "Vous ne pouvez télécharger que des fichiers de type JPG, JPEG, PNG, ou GIF.";
        }
    } else {
        $message = "Erreur dans le téléchargement de l'image.";
    }

    if ($message === '') {
        $sql = "INSERT INTO Vehicles (make, model, year, mileage, price, user_id, image_path) VALUES (?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssiiis", $make, $model, $year, $mileage, $price, $user_id, $uploadDirectory);

            if ($stmt->execute()) {
                $message = "Véhicule ajouté avec succès.";
            } else {
                $message = "Erreur : " . $stmt->error;
            }

            $stmt->close();
        } else {
            $message = "Erreur de préparation : " . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212; 
            color: #e0e0e0; 
        nav a, footer a {
            color: #ff5555; 
        form {
            max-width: 600px; 
            margin: auto; 
        input, button {
            background-color: #333; 
            border: 1px solid #444;
            color: #fff;
        }
        button {
            background-color: #ff5555; 
            border-color: #ff5555;
        }
        button:hover {
            background-color: #ff3333; 
            border-color: #ff3333;
        }
    </style>
    <title>Add Vehicle to Garage</title>
</head>
<body>
<nav class="container-fluid">
    <ul>
        <li><strong>Garage</strong></li>
    </ul>
    <ul>
        <li><a href="../html/accueil/index.html">Home</a></li>
        <li><a href="../PHP/list_vehicles.php">My Vehicles</a></li>
        <li><a href="#" role="button">Add Vehicle</a></li>
    </ul>
</nav>
<main class="container">
    <h1>Add Vehicle to Garage</h1>
    <?php if (!empty($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
        <label for="make">Make:</label>
        <input type="text" id="make" name="make" required>
        
        <label for="model">Model:</label>
        <input type="text" id="model" name="model" required>
        
        <label for="year">Year:</label>
        <input type="number" id="year" name="year" required min="1900" max="2099">
        
        <label for="mileage">Mileage:</label>
        <input type="number" id="mileage" name="mileage" required>
        
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required step="0.01">
        
        <label for="vehicleImage">Image:</label>
        <input type="file" id="vehicleImage" name="vehicleImage" accept="image/*">
        
        <button type="submit">Add Vehicle</button>
    </form>
</main>
<footer class="container">
    <small><a href="/privacy-policy">Privacy Policy</a> • <a href="/terms">Terms of Service</a></small>
</footer>
</body>
</html>
