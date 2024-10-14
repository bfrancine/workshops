<?php
session_start(); // Inicia la sesión 
include('../utils/functions.php'); 

// Obtiene los datos del formulario
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$province = $_POST['province_id'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

// Validación de datos
if (empty($firstName) || empty($lastName) || empty($province) || empty($email) || empty($password)) {
    header("Location: ../signup.php?error=Please fill in all fields");
    exit();
}


// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'bdworkshop4'); // Cambia según tu configuración

// Verifica la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Hashea la contraseña con MD5
$hashedPassword = md5($password);
// Consulta para insertar los datos en la tabla
$sql = "INSERT INTO users (firstName, lastName, email,province_id,  password, role) VALUES (?, ?, ?, ?, ?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $firstName, $lastName,  $email, $province, $hashedPassword, $role);

// Ejecuta la consulta
if ($stmt->execute()) {
    // Registro exitoso 
 
    header("Location: ../index.php");
    
} else {
    // Manejo del error
    header("Location: ../signup.php?error=Error: " . $stmt->error);
}

// Cierra la declaración y la conexión
$stmt->close();
$conn->close();
?>