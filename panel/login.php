<?php
// Comprobar si hay un mensaje de error en la URL
$error_message = isset($_GET['error']) ? $_GET['error'] : '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="styles/cliente/login.css">
</head>
<body>

<section class="form-login">
    <h2>Iniciar Sesión</h2>
    
    <!-- MENSJAE DE ERROR -->
    <?php if ($error_message): ?>
        <div class="error-message">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <form action="controllers/validar_user.php" method="POST">
        <input class="controls" type="email" id="email" name="email" placeholder="Email" required>
        <input class="controls" type="password" id="password" name="password" placeholder="Contraseña" required>
        <input class="buttons" type="submit" value="Iniciar Sesión">
    </form>
</section>

</body>
</html>
