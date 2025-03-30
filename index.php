<?php 
require_once 'includes/db_connect.php';
require_once 'includes/check_session.php';



?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StoryTeller project</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>StoryTeller Project</h1>
        <nav>
            <ul>
                <li><a href="views/stories.html">Stories</a></li>
                <?php if (!isLoggedIn()): ?>
                    <li><a href="views/login.php">Login</a></li>
                    <li><a href="views/register.html">Register</a></li>
                <?php else: ?>
                    <li><a href="views/profile.php">Perfil</a></li>
                    <li><a href="php/logout.php">Cerrar sesión</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <?php if (isLoggedIn()): ?>
            <p class="user-status">Conectado como: <?php echo htmlspecialchars(getCurrentUsername());?></p>
            <?php endif;?>
    </header>

    <main class="three-columns">
        <section class="welcome">
            <h2>Bienvenido a nuestra página de escritores.</h2>
            <p>Un espacio donde la creatividad se construye entre muchos</p>
        </section>
    
        <div class="columns-container">
            <section class="column">
            <h2>Los cuentos inconclusos.</h2>
            <div class="stories-list">
                <!-- Es aquí donde se mostrarán los cuentos no finalizados. -->
            </div>
            </section>
            
            <section class="column">
                <h2>Empezar un cuento</h2>
            </section>

            <section class="column">
                <h2>La colección</h2>
                <div class="stories-list">
                    <!-- Es aquí donde se mostrarán los cuentos no finalizados. -->
                </div>
            </section>
        </div>
    </main>
    <footer>
        <p>&copy; 2025 StoryTeller project</p>
    </footer>
</body>
</html>