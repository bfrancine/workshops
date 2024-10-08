<?php
require('functions.php');

$conn = getConnection();
if ($conn) {
    echo "Conexión exitosa";
} else {
    echo "Error en la conexión";
}
?>
