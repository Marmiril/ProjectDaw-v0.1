<?php
require_once __DIR__ . '/../includes/check_session.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario - StoryTeller Project</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <h1>StoryTeller Project</h1>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="stories.html">Stories</a></li>
                <li><a href="../php/logout.php">Cerrar sesión</a></li>
            </ul>
        </nav>
        <?php if (isLoggedIn()): ?>
            <p class="user-status">CONECTADO COMO: <?php echo htmlspecialchars(getCurrentUserName());?></p>
        <?php endif; ?>   
        
    </header>

    <main>
        <section class="profile-section">
            <h2>Bienvenido, <?php echo getCurrentUsername(); ?></h2>
            <div id="user-info">
                <!-- Aquí se mostrarán los datos del usuario -->
            </div>
        </section>

        <section class="create-story-section">
            <h2>Crear Nueva Historia</h2>
            <form id="createStoryForm">
                <input type="hidden" name="user_id" value="<?php echo getCurrentUserId(); ?>">
                <div class="form-group">
                    <label for="story-title">Título:</label>
                    <input type="text" id="story-title" name="title" required>
                </div>

                <div class="form-group">
                    <label for="story-theme">Tema:</label>
                    <select id="story-theme" name="theme" required>
                        <option value="">Selecciona un tema</option>
                        <option value="comedia">Comedia</option>
                        <option value="romance">Romance</option>
                        <option value="terror">Terror</option>
                        <option value="ciencia-ficcion">Ciencia Ficción</option>
                        <option value="fantasia">Fantasía</option>
                        <option value="aventura">Aventura</option>
                        <option value="misterio">Misterio</option>
                    </select>
                </div>

            <div class="form-group">
                <label for="story-guide">Palabra guía</label>
                <input type="text" id="story-guide" name="guide_word" required>
            </div>

            <div class="form-group">
                <label for="story-steps">Número de pasos/colaboraciones</label>
                <select id="story-steps" name="max_steps" required>
                    <option value="">Seleccione el nº de pasos</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                </select>
            </div>

                <div class="form-group">
                    <label for="story-content">Tu cuento:</label>
                        <div class="textarea-container">
                            <textarea id="story-content" name="content" rows="10" required></textarea>
                            <div id="word-count" class="word-count-overlay">Palabras: 0</div>
                    </div>
                </div>

                <button type="submit">Guardar Historia</button>
            </form>
        </section>
    </main>

    <script src="../js/create_tale.js"></script>
</body>
</html>
