<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

// Crea conexión con la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) { //num_rows es una propiedad sql funciona para saber cuantas filas devuelve una consulta sql, por lo que permite saber si viene vacio o no
    
    echo "<table border='10'>";
    echo "User registration Data";

    
    echo "<tr>";
        echo "<th>First Name</th>"; 
        echo "<th>Last Name</th>";  
        echo "<th>Email</th>";      
        echo "<th>Province</th>";   
    echo "</tr>";

    // Bucle que ayuda a mostrar los datos
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
            echo "<td>" . $row['firstName'] . "</td>"; //row es un array asociativo el "." concatena
            echo "<td>" . $row['lastName'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['province'] . "</td>";
            echo "<td>" . $row['password'] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    
} else {
    echo "No se encontraron resultados.";
}

// Cerrar la conexión
$conn->close();
?>
    <br><button type="button" class="btn btn-secondary" onclick="window.location.href='index.php'">Back</button>
    <a href='crud/updateUser.php?firstName={$show['firstName']}' class='btn'>Modify</a>
    <a href='deleteUser.php?firstName={$show['firstName']}' class='btn' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>
<?php require('inc/footer.php');