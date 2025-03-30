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
    
    <main class="three-columns">
        <section class="welcome">
            <h2>Bienvenido <?php echo htmlspecialchars(getCurrentUsername());?></h2>
        </section>

        <div class="columns-container">
            <section class="column">
                <h2>Mis colaboraciones</h2>
                <div class="stories-list">
                    <!-- Aquí irán los cuentos en progreso del usuario -->
                </div>
            </section>

            <section class="column">
                <h2>Crear nuevo cuento</h2>
                <button id="btnCreateStory" class="create-story-btn">Comenzar</button>
            </section>

            <section class="column">
                <h2>Mi Colección</h2>
                <div class="stories-list">
                    <!-- Aquí irán los cuentos finalizados -->
                </div>
            </section>
        </div>
    </main>
    <footer>
        <p>&copy; 2023 StoryTeller Project. Todos los derechos reservados.</p>
    </footer>
</body>
</html>