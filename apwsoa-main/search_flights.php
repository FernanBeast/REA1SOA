<?php
require 'db.php';

// Buscar vuelos
$origin = $_POST['origin'];
$destination = $_POST['destination'];
$sql = "SELECT * FROM Flights WHERE origin='$origin' AND destination='$destination'";
$result = $conn->query($sql);
$flights = [];
while ($row = $result->fetch_assoc()) {
    $flights[] = $row;
}
echo json_encode($flights);

$conn->close();
?>
