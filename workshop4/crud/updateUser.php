<?php
echo('hello update');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user = null; // Definir la variable $user para evitar errores

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE firstName = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = @$_REQUEST['firstName'];
    $lastName = @$_REQUEST['lastName'];
    $email = @$_REQUEST['email'];
    $province = @$_REQUEST['province'];
    $password = @$_REQUEST['password'];

    // Solo encripta la contraseña si ha sido cambiada
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Encripta la nueva contraseña
    } else {
        $hashed_password = $user['password']; // mantiene la contraseña antigua si no ha sido cambiada
    }

    $sql = "UPDATE users SET firstName = ?, lastName = ?, province = ?, email = ?, password = ? WHERE firstName = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $firstName, $lastName, $province, $email, $hashed_password, $id);
    
    if ($stmt->execute()) {
        header("Location: utils/users.php?message=User updated successfully");
        exit;
    } else {
        echo "Error updating user: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <nav class="nav-bar">
            <a href="table.php" class="nav-link">Back</a>
        </nav>
    </header>
    <div class="container">
        <h1>Update User</h1>
        <?php if ($user): ?>
            <form action="" method="POST">
                <label for="firstName">First Name:</label>
                <input type="text" name="firstName" value="<?php; ?>" required>
                <label for="lastName">Last Name:</label>
                <input type="text" name="lastName" value="<?php echo $user['lastName']; ?>" required>
                <label for="province">Province:</label>
                <input type="text" name="province" value="<?php echo $user['province']; ?>" required>
                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Enter new password">
                <input type="submit" value="Update" class="btn">
            </form>
        <?php else: ?>
            <p>User data not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>

