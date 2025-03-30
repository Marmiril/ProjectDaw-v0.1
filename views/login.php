<?php
require_once __DIR__ . '/../includes/check_session.php';

//Si ya está logueado, redirigir a profile.
if (isLoggedIn()) {
    header('Location: profile.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - StoryTeller Project</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<header>
        <h1>StoryTeller Project</h1>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="views/stories.html">Stories</a></li>
                <?php if (!isLoggedIn()): ?>
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
    <main>
        <section class="login-section">
            <h2>Iniciar Sesión</h2>
            <?php if (isset($error)): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>

            <form action="../php/process_login.php" method="POST">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit">Iniciar Sesión</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 StoryTeller Project. Todos los derechos reservados.</p>
</body>
</html>