<?php
echo("The Name is ". $_POST['name']. "<br>");
echo("The Last Name is ". $_POST['lastname']. "<br>");
echo("The phone Number is ". $_POST['celphonenumber'] . "<br>");
echo("The email is ". $_POST['email'] . "<br>");
?>

<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "personal_information";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa<br>";

$sql = "INSERT INTO information (name, lastname, celphonenumber, email)
        VALUES ('" . $_POST['name'] . "', '" . $_POST['lastname'] . "', '" . $_POST['celphonenumber'] . "', '" . $_POST['email'] . "')";

if ($conn->query($sql) === TRUE) {
    echo "Datos insertados correctamente";
} else {
    echo "Error al insertar datos: " . $conn->error;
}

// Cerrar conexión
$conn->close();


?>

