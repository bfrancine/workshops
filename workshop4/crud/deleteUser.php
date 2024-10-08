<?php
echo "ingresé a eliminar"
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM users WHERE firstName = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: table.php?message=User deleted successfully");
        exit;
    } else {
        echo "Error deleting user: " . $stmt->error;
    }
} else {
    echo "No found firstName.";
}
?>