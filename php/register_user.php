<?php
require_once '../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Si sólo estamos verificando el mail.
    if(isset($_POST['check_email'])) {
        $email = $_POST['email'];
        try {
            $db = connectDB();
            $checkUser = $db->prepare("SELECT * FROM users WHERE email = ?");
            $checkUser->bind_param("s", $email); // Corregido: era 'email' en lugar de $email
            $checkUser->execute();
            $result = $checkUser->get_result();

            header('Content-Type: application/json');
            echo json_encode(['exists' => $result->num_rows > 0]);
            exit();
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode (['error' => true]);
            exit();
        }
    }

    //Si se trata de un registro completo
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $db = connectDB();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashedPassword); // Corregido: era bind_params

        if ($stmt->execute()) {
            $userId = $db->insert_id;

            //Iniciar sesión después del registro.
            session_start();
            $_SESSION['user_id'] = $userId;
            $_SESSION['username'] = $username;
            $_SESSION['logged_in'] = true;
            
            //Inicializar preferencias vacías.
            $initPrefs = $db->prepare("INSERT INTO user_preferences (user_id) VALUES (?)");
            $initPrefs->bind_param("i", $userId);
            $initPrefs->execute();

            header("Location: /A01/views/user_preferences.html?id=" . $userId);
            exit();
        } else {
            throw new Exception("Error al registrar el usuario.");
        }
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    } finally {
        if (isset($db)) {
            $db->close();
        }
    }
}
?>