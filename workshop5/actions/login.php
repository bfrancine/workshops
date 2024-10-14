<?php
// Conexión a la base de datos 
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'users';

$conn = new mysqli($host, $user, $password, $db);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtén los datos ingresados por el usuario
    $email = $_POST['email'];
    $input_password = $_POST['password'];

    // Prepara una consulta para obtener el hash almacenado y el estado del usuario
    $sql = "SELECT password, status FROM users WHERE email = ?";
    
    // Prepara la sentencia
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    
    // Ejecuta la consulta
    $stmt->execute();
    
    // Obtiene el resultado
    $result = $stmt->get_result();
    
    // Verifica si el usuario existe
    if ($result->num_rows > 0) {
        // Obtiene los datos del usuario
        $user = $result->fetch_assoc();
        $stored_hash = $user['password'];  // El hash MD5 almacenado
        $status = $user['status'];  // El estado del usuario
        
        // Verifica si el estado del usuario es "active"
        if ($status !== 'active') {
            echo "Tu cuenta está inactiva. Contacta al administrador.";
        } else {
            // Genera el hash MD5 de la contraseña ingresada
            $input_hash = md5($input_password);
            
            // Compara el hash generado con el hash almacenado
            if ($input_hash === $stored_hash) {
                // Actualiza la fecha de último inicio de sesión
                $update_sql = "UPDATE users SET last_login_datetime = NOW() WHERE email = ?";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->bind_param("s", $email);
                $update_stmt->execute();

                // Login exitoso
                echo "Inicio de sesión exitoso.";
                echo "<script>
                window.open('../users.php', '_blank');
                window.location.href = '../users.php';
                </script>";

                // Cierra la sentencia de actualización
                $update_stmt->close();
            } else {
                // Contraseña incorrecta
                echo "Contraseña incorrecta.";
            }
        }
    } else {
        echo "No se encontró una cuenta con ese correo.";
    }

    // Cierra la sentencia
    $stmt->close();
}

// Cierra la conexión
$conn->close();
?>
