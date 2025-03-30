<?php
require_once __DIR__ . '/includes/db_connect.php';

try {
    $db = connectDB();
    echo "¡Conexión exitosa a la base de datos!";
    $db->close();
} catch (Exception $e) {
    echo "Error de conexión:" . $e->getMessage();
}
?>