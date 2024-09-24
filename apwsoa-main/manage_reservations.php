<?php
require 'db.php';

// Obtener reservas
$user_id = $_POST['user_id'];
$sql = "SELECT * FROM Reservations WHERE user_id='$user_id'";
$result = $conn->query($sql);
$reservations = [];
while ($row = $result->fetch_assoc()) {
    $reservations[] = $row;
}
echo json_encode($reservations);

$conn->close();
?>
