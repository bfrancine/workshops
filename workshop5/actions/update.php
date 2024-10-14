<?php
include('../utils/functions.php');

// Obtiene los datos del formulario
$email = $_POST['email'] ?? null;
$firstName = $_POST['firstName'] ?? null;
$lastName = $_POST['lastName'] ?? null;
$province = $_POST['province_id'] ?? null;
$password = $_POST['password'] ?? null; // Nueva contraseña (puede estar vacía)
$role = $_POST['role'] ?? null;

// Validación de datos
if (empty($firstName) || empty($lastName) || empty($province) || empty($role)) {
    header("Location: ../update.php?email={$email}&error=Por favor, complete todos los campos");
    exit();
}

// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'bdworkshop4');

// Verifica la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta para verificar si el usuario existe
$checkEmail = $conn->prepare("SELECT * FROM users WHERE email = ?");
$checkEmail->bind_param("s", $email);
$checkEmail->execute();
$result = $checkEmail->get_result();

if ($result->num_rows === 0) {
    header("Location: ../update.php?email={$email}&error=El usuario no existe");
    exit();
}

// Consulta para actualizar los datos del usuario
if (!empty($password)) {
    // Si se proporciona una nueva contraseña, se debe actualizar
    $hashedPassword = md5($password);
    $sql = "UPDATE users SET firstName = ?, lastName = ?, province_id = ?, password = ?, role = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        die("Error en la preparación de la declaración: " . $conn->error);
    }
    
    $stmt->bind_param("ssssss", $firstName, $lastName, $province, $hashedPassword, $role, $email);
} else {
    // Si no se proporciona una nueva contraseña, se omite la actualización de la contraseña
    $sql = "UPDATE users SET firstName = ?, lastName = ?, province_id = ?, role = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        die("Error en la preparación de la declaración: " . $conn->error);
    }

    $stmt->bind_param("sssss", $firstName, $lastName, $province, $role, $email);
}

// Ejecuta la consulta
if ($stmt->execute()) {
    // Registro exitoso, redirige a la página de éxito o muestra un mensaje
    header("Location: ../index.php"); 
} else {
    // Manejo del error
    header("Location: ../update.php?email={$email}&error=Error: " . $stmt->error);
}

// Cierra la declaración y la conexión
$stmt->close();
$conn->close();
?>