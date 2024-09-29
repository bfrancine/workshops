<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

// Crea conexión con la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta para obtener los datos de province_name de la tabla province
$sql = "SELECT * FROM users";
$result = $conn->query($sql);


// Cerrar la conexión
$conn->close();
?>