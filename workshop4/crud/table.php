<?php
echo('hello table');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>See Users</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <nav class="nav-bar">
            <a href="../index.php" class="nav-link">Back</a>
        </nav>
    </header>
    <div class="container">
        <h1>List of Users</h1>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Lastname</th>
                    <th>Province</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
    <?php
        // obtiene todos lso usuarios
        $sql = "SELECT * FROM users";
        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) > 0) {

            while($show = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$show['name']}</td>
                        <td>{$show['lastname']}</td>
                        <td>{$show['province']}</td>
                        <td>{$show['phone']}</td>
                        <td>{$show['email']}</td>
                        <td>{$show['password']}</td>
                        <td>
                            <a href='updateUser.php?id={$show['firstName']}' class='btn'>Modify</a>
                            <a href='deleteUser.php?id={$show['firstName']}' class='btn' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No users found</td></tr>"; // Show a message if not found an user
        }
        mysqli_close($conexion);
    ?>
</tbody>

        </table>
    </div>
</body>
</html>