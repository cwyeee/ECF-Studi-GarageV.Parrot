<?php
include 'db.php'; 

$query = "SELECT * FROM vehicles";
$result = $conn->query($query);

if (!$result) {
    die("Erreur de requête : " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Véhicules</title>
    <link rel="stylesheet" href="/../css/Style-2.css">
</head>

<body>

    <form action="" method="GET">
        <label for="search_make">Marque:</label>
        <input type="text" id="search_make" name="search_make">

        <label for="search_model">Modèle:</label>
        <input type="text" id="search_model" name="search_model">

        <label for="search_year">Année:</label>
        <select id="search_year" name="search_year">
            <option value="">Toutes</option>
            <option value="2020">2020</option>
            <option value="2019">2019</option>
        </select>

        <label for="search_price">Prix maximum:</label>
        <input type="number" id="search_price" name="search_price">

        <input type="submit" value="Rechercher">
    </form>
    <h1>Liste des Véhicules</h1>
    <table border="1">
        <tr>
            <th>Marque</th>
            <th>Modèle</th>
            <th>Année</th>
            <th>Kilométrage</th>
            <th>Prix</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['make']) . "</td>";
                echo "<td>" . htmlspecialchars($row['model']) . "</td>";
                echo "<td>" . htmlspecialchars($row['year']) . "</td>";
                echo "<td>" . htmlspecialchars($row['mileage']) . "</td>";
                echo "<td>" . htmlspecialchars($row['price']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Aucun véhicule trouvé</td></tr>";
        }
        ?>
    </table>
    
</body>
</html>
