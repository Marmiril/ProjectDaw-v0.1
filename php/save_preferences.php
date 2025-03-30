<?php
error_log("Datos recibidos:");
error_log("user_id: " . $_POST['user_id']);
error_log("favorite_number: " . $_POST['favorite_number']);
error_log("favorite_color: " . $_POST['favorite_color']);
error_log("height: " . $_POST['height']);
error_log("weight: " . $_POST['weight']);
error_log("age: " . $_POST['age']);
error_log("gender: " . $_POST['gender']);
require_once __DIR__ . '/../includes/db_connect.php';

if($_SERVER ['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $favorite_number = $_POST['favorite_number'];
    $favorite_color = $_POST['favorite_color'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    try {
        $db = connectDB();

        $stmt = $db->prepare("UPDATE user_preferences SET 
            favorite_number = ?,
            favorite_color = ?, 
            height = ?, 
            weight = ?,
            age = ?, 
            gender = ?
            WHERE user_id = ?");

        $stmt->bind_param("isddisi", 
            $favorite_number,
            $favorite_color,
            $height,
            $weight,
            $age,
            $gender,
            $user_id);

        if($stmt->execute()) {
            header("Location:../views/profile.php");
            exit();
        } else {
            throw new Exception("Error al guardar las preferencias");
        } 
        
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    } finally {
        if(isset ($db)) {
            $db->close();
        }
    }
}

?>