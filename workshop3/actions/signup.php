<?php
echo("The Name is ". $_POST['firstName']. "<br>");
echo("The Last Name is ". $_POST['lastName']. "<br>");
echo("The email is ". $_POST['email'] . "<br>");
echo("The province is ". $_POST['province'] . "<br>");
echo("The password is ". $_POST['password'] . "<br>");
?>

<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa<br>";

$sql = "INSERT INTO users (firstName, lastName, email, province, password)
        VALUES ('" . $_POST['firstName'] . "', '" . $_POST['lastName'] . "', '" . $_POST['email'] . "', '" . $_POST['province'] . "', '" . $_POST['password'] . "')";

if ($conn->query($sql) === TRUE) {
    echo "Datos insertados correctamente";
} else {
    echo "Error al insertar datos: " . $conn->error;
}

// Cerrar conexión
$conn->close();


?>