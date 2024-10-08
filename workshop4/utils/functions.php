<?php

/**
 *  Gets the provinces from the database
 */
function getProvinces(): array {
  //select * from provinces
  return [1 => 'Alajuela', 2 => 'San Jose', 3 => 'Cartago', 80 => 'Heredia', 90 => 'Limon', 100 => 'Puntarenas', 200 => 'Guanacaste'];
}

function getConnection(): mysqli|false {
    $servername = "localhost"; // Nombre del servidor
    $username = "root";         // Usuario de la base de datos
    $password = "";             // Contraseña de la base de datos
    $dbname = "users";          // Nombre de la base de datos
    
    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Verificar si hubo un error en la conexión
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    return $conn; // Retornar la conexión si es exitosa
}


/**
 * Saves an specific user into the database
 */
function saveUser($user): bool{

  $firstName = $user['firstName'];
  $lastName = $user['lastName'];
  $username = $user['email'];
  $password = md5($user['password']);

  $sql = "INSERT INTO users (firstName, lastName, email, password) VALUES('$firstName', '$lastName', '$username','$password')";

  try {
    $conn = getConnection();
    mysqli_query($conn, $sql);
  } catch (Exception $e) {
    echo $e->getMessage();
    return false;
  }
  return true;
}

/**
 * Get one specific student from the database
 *
 * @id Id of the student
 */
function authenticate($username, $password): bool|array|null{
  $conn = getConnection();
  $password = md5($password);
  $sql = "SELECT * FROM users WHERE `email` = '$username' AND `password` = '$password'";
  $result = $conn->query($sql);

  if ($conn->connect_errno) {
    $conn->close();
    return false;
  }
  $results = $result->fetch_array();
  $conn->close();
  return $results;
}