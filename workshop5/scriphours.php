<?php
// Habilita la visualización de errores para desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Database {
    private $connection;

    public function __construct($host, $user, $pass, $dbname) {
        $this->connection = new mysqli($host, $user, $pass, $dbname);
        if ($this->connection->connect_error) {
            die("Conexión fallida: " . $this->connection->connect_error);
        }
    }

    public function deactivateInactiveUsers($hours) {
        // Consulta para actualizar usuarios inactivos
        $sql = "UPDATE users SET status = 'inactive' WHERE status = 'active' 
                AND last_login_datetime < NOW() - INTERVAL ? HOUR";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $hours);
        
        if ($stmt->execute()) {
            echo "Usuarios actualizados exitosamente a inactivos.\n";
        } else {
            echo "Error al actualizar usuarios: " . $stmt->error;
        }

        $stmt->close();
    }

    public function close() {
        $this->connection->close();
    }
}

// Verifica el número de argumentos
if ($argc !== 2) {
    echo "Uso: php validateActiveSessions.php <horas>\n";
    exit();
}

$hours = (int)$argv[1];

// Crea la instancia de la clase y llama al método
$db = new Database("localhost", "root", "", "users");
$db->deactivateInactiveUsers($hours);
$db->close();
?>