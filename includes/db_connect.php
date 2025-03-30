<?php
require_once __DIR__ . '/../config/config.php';

function connectDB() {
    try {
        $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $conexion->set_charset("utf8");

        if($conexion->connect_error) {
            throw new Exception("Error de conexión: " . 
            $conexion->connect_error);
        }
        return $conexion;    
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
}
?>