<?php
include 'db.php'; // Inclure le fichier de connexion à la base de données

// Vérifier si le formulaire a été soumis via la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Préparation de la requête SQL pour éviter les injections SQL
    $stmt = $conn->prepare("INSERT INTO Vehicles (make, model, year, mileage, price, user_id, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiiisi", $make, $model, $year, $mileage, $price, $user_id, $image);

    // Assignation des valeurs et exécution de la requête préparée
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $mileage = $_POST['mileage'];
    $price = $_POST['price'];
    $user_id = 1; // Vous devrez modifier cette partie pour associer le véhicule à un utilisateur connecté
    $image = 'default.png'; // Ici aussi, vous devrez adapter selon la manière dont vous gérez l'upload d'image

    // Exécuter la requête
    if ($stmt->execute()) {
        echo "Nouveau véhicule ajouté avec succès";
        // Redirection vers une page de confirmation ou de retour
        header("Location: success.html");
        exit();
    } else {
        echo "Erreur : " . $stmt->error;
    }

    // Fermer le statement et la connexion
    $stmt->close();
    $conn->close();
} else {
    // Si le formulaire n'a pas été soumis via POST, rediriger vers le formulaire
    header("Location: add_vehicle.html");
    exit();
}
?>
