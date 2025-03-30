<?php
session_start();
require_once __DIR__ . '/../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $db = connectDB();
        $stmt = $db->prepare("SELECT id, email, username, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($user = $result->fetch_assoc()) {
            if (password_verify($password, $user['password'])) {
                // Guardar datos en la sesión.
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['logged_in'] = true;
                
                header('Location: ../views/profile.php');
                exit();
            } else {
                //$error = "Contraseña incorrecta";
                //header('Location: ../views/login.php');
                echo json_encode(['error' => 'Contrseña incorrecta']);
                //exit();
            }
        } else {
            //$error = "Usuario no encontrado";
            echo json_encode(['error' => 'Usuario no encotrado']);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => 'Error en el servidor:' .
        $e->getMessage()]);
        
    }
}
?>