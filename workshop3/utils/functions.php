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
$sql = "SELECT * FROM provinces";
$result = $conn->query($sql);

// Verificar si hay resultados y mostrarlos
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='" . htmlspecialchars($row['province_name'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($row['province_name'], ENT_QUOTES, 'UTF-8') . "</option>";
    }
} else {
    echo "<option value=''>No provinces found</option>";
}

// Cerrar la conexión
$conn->close();
?>
