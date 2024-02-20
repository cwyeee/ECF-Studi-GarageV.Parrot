<?php
include 'db.php'; 

$sql = "SELECT * FROM Vehicles"; 
$result = $conn->query($sql); 

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Marque: " . $row["make"]. " - Modèle: " . $row["model"]. "<br>";
    }
} else {
    echo "0 résultats";
}
$conn->close(); 
?>
