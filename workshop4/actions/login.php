<?php
echo('hello');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start(); 

if ($_POST) {
    $newUsername = $_POST['email'];
    $newPassword = md5($_POST['password']); 

    // Consulta para autenticar al usuario
    $sql = "SELECT * FROM users WHERE email = '$newUsername' AND password = '$newPassword'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // El usuario existe
        echo('el usuario existe');
        $_SESSION['firstName'] = $newUsername; // Guarda el nombre de usuario en la sesión
        header('Location: ../signup.php'); // Redirige a la página que queremos
        exit();
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
}

$conn->close();
?>

