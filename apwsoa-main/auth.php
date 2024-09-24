<?php
require 'db.php';

// Verificar si se ha enviado la acción
if (isset($_POST['action'])) {
    // Registro de usuario
    if ($_POST['action'] == 'register') {
        $user = $conn->real_escape_string($_POST['username']);
        $pass = $conn->real_escape_string($_POST['password']); // Sin encriptar
        $email = $conn->real_escape_string($_POST['email']);
        
        // Insertar usuario en la base de datos
        $sql = "INSERT INTO Users (username, password, email) VALUES ('$user', '$pass', '$email')";
        if ($conn->query($sql) === TRUE) {
            echo "Registro exitoso";
        } else {
            echo "Error: " . $conn->error;
        }
    }

    // Inicio de sesión
    elseif ($_POST['action'] == 'login') {
        $user = $conn->real_escape_string($_POST['username']);
        $pass = $conn->real_escape_string($_POST['password']); // Sin encriptar
        
        // Buscar el usuario
        $sql = "SELECT password FROM Users WHERE username='$user'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($pass === $row['password']) { // Comparación directa
                echo "Inicio de sesión exitoso";
            } else {
                echo "Credenciales inválidas";
            }
        } else {
            echo "No existe el usuario";
        }
    }
} else {
    echo "No se ha enviado ninguna acción.";
}

$conn->close();
?>
