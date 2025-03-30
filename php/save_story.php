<?php
require_once __DIR__ . '/../includes/db_connect.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $db = connectDB();
        
        // Verificar si ya existe una historia con el mismo título del mismo usuario
        $checkStory = $db->prepare("SELECT id FROM stories WHERE title = ? AND user_id = ?");
        $checkStory->bind_param("si", $title, $user_id);
        $checkStory->execute();
        $result = $checkStory->get_result();
        
        if ($result->num_rows > 0) {
            throw new Exception("Ya has creado un cuento con este título");
        }

        //Validar user_id
        if(!isset($_POST['user_id']) || empty($_POST['user_id'])) {
            throw new Exception("Usuario no identificado");
        }
        // Obtener datos del formulario
        $title = $_POST['title'];
        $theme = $_POST['theme'];
        $guide_word = $_POST['guide_word'];
        $max_steps = $_POST['max_steps'];
        $content = $_POST['content'];
        $user_id = $_POST['user_id'];

        //Insertar en la base de datos.
        $stmt = $db->prepare("INSERT INTO stories (title, theme, guide_word, max_steps, current_step, user_id, created_at)
        VALUES (?, ?, ?, ? , 1, ?, NOW())");
        $stmt->bind_param('sssii', $title, $theme, $guide_word, $max_steps, $user_id);  // Corregido el guión por flecha
         
        if ($stmt->execute()) {
            $story_id = $db->insert_id;
            
            // Crear directorio si no existe
            $storiesDir = __DIR__ . "/../stories";
            if (!file_exists($storiesDir)) {
                mkdir($storiesDir, 0777, true);
            }

            //Guardar el archivo de texto.
            $filename = "story_{$story_id}_step_1.txt";
            $filepath = $storiesDir . "/" . $filename;
            
            if (file_put_contents($filepath, $content)) {
                echo json_encode(['success' => true]);
            } else {
                throw new Exception("Error al guardar el archivo de texto");
            }
        } else {
            throw new Exception("Error al guardar en la base de datos");
        }
        
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
}
?>