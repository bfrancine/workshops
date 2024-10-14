<?php

/**
 *  Gets the provinces from the database
 */
function getProvinces(): array {
  $connection = getConnection();
 $sql = "SELECT province_name FROM provinces";
 $result = $connection->query($sql);
 
 $provinces = [];
 if ($result->num_rows > 0) {
     while($row = $result->fetch_assoc()) {
         $provinces[] = $row;
     }
 }
 $connection->close();
 return $provinces;
}

//obtener los roles
function getRole(): array {
  $connection = getConnection();
 $sql = "SELECT role FROM roles";
 $result = $connection->query($sql);
 
 $role = [];
 if ($result->num_rows > 0) {
     while($row = $result->fetch_assoc()) {
         $role[] = $row;
     }
 }
 $connection->close();
 return $role;
}

function getConnection() {
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

  return $conn;
}
function getUserByEmail($email) {
  $conn = getConnection();
  
  //  obtener el usuario por correo
  $sql = "SELECT * FROM users WHERE email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  
  // Ejecuta la consulta
  $stmt->execute();
  $result = $stmt->get_result();
  
  // Verifica si se encontró el usuario
  if ($result->num_rows > 0) {
      // Devuelve los datos del usuario
      return $result->fetch_assoc();
  } else {
      return null; // Retorna null si no se encontró el usuario
  }

  // Cierra la declaración y la conexión
  $stmt->close();
  $conn->close();
}


/**
 * Saves an specific user into the database
 */
function saveUser($user) {
  $conn = getConnection();

  // Usamos password_hash para hashear la contraseña antes de almacenarla
  $hashedPassword = password_hash($user['password'], PASSWORD_BCRYPT);

  // Preparamos la consulta
  $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, province, password) VALUES (?, ?, ?, ?, ?)");

  // Vinculamos los parámetros
  $stmt->bind_param("sssiss", $user['firstName'], $user['lastName'], $user['email'], $user['province'], $hashedPassword);

  // Ejecutamos la consulta
  if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    return true;
  } else {
    // Si hay un error, lo cerramos y devolvemos false
    $stmt->close();
    $conn->close();
    return false;
  }
}


/**
 * Get one specific student from the database
 *
 * @id Id of the student
 */
/*function authenticate($email, $password) {
  // Conexión a la base de datos
  $conn = new mysqli('localhost', 'root', '', 'bdworkshop4'); // Cambia según tu configuración

  // Verifica la conexión
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // Consulta para buscar al usuario por email
  $sql = "SELECT * FROM users WHERE email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  // Verifica si se encontró el usuario
  if ($result->num_rows > 0) {
      $user = $result->fetch_assoc();

      // Verifica la contraseña
      if (password_verify($password, $user['password'])) {
          return $user; // Retorna el usuario para ser almacenado en la sesión
      }
  }
  return false; // Devuelve false si no se encuentra el usuario o la contraseña no coincide
}*/

  
function getAllUsers() {
  // Conexión a la base de datos
  $conn = new mysqli('localhost', 'root', '', 'users');

  // Verifica la conexión
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // Consulta para obtener todos los usuarios
  $sql = "SELECT email, firstName, lastName FROM users"; // Asegúrate de que estos campos existan en tu tabla
  $result = $conn->query($sql);

  $users = [];
  if ($result->num_rows > 0) {
      // Almacena los usuarios en un array
      while ($row = $result->fetch_assoc()) {
          $users[] = $row;
      }
  }

  // Cierra la conexión
  $conn->close();

  return $users;
}

