<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flight_reservation";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verificar si se ha enviado el ID de usuario y el ID de vuelo
if (isset($_POST['user_id']) && isset($_POST['flight_id'])) {
    $user_id = $conn->real_escape_string($_POST['user_id']);
    $flight_id = $conn->real_escape_string($_POST['flight_id']);
    
    // Insertar la reserva en la base de datos
    $sql = "INSERT INTO Reservations (user_id, flight_id) VALUES ('$user_id', '$flight_id')";
    if ($conn->query($sql) === TRUE) {
        echo "Reserva exitosa para el usuario ID: $user_id, Vuelo ID: $flight_id";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Por favor, proporciona el ID de usuario y el ID de vuelo.";
}

$conn->close();
?>
