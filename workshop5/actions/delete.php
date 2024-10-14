<?php
include('../utils/functions.php'); 

// Obtiene el email del formulario
$email = $_POST['email'] ?? null;

// Validación básica
if (empty($email)) {
    header("Location: ../deleteuser.php?error=El email está vacío");
    exit();
}

// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'bdworkshop4');

// Verifica la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta para eliminar al usuario
$sql = "DELETE FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);

// Ejecuta la consulta
if ($stmt->execute()) {
    // Redirige a la página de éxito o muestra un mensaje
    header("Location: ../index.php"); 
} else {
    // Manejo del error
    header("Location: ../deleteuser.php?error=Error: " . $stmt->error);
}

// Cierra la declaración y la conexión
$stmt->close();
$conn->close();
?>
