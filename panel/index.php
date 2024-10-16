<?php
// Comprobar si hay un mensaje de error en la URL
$error_message = isset($_GET['error']) ? $_GET['error'] : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de control</title>
    <link rel="stylesheet" href="styles/admin/login.css">
    </head>
<body>

<section class="form-login">
    <h5>Formulario Login</h5>
    <form action="controllers/validar_admin.php" method="POST">
              <!-- Mostrar mensaje de error si existe -->
      <?php if ($error_message): ?>
        <div class="error-message">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>
      
        <input class="controls" type="email" id="email" name="email" placeholder="Email" required>
        <input class="controls" type="password" name="password" id="password" placeholder="Contraseña" required>
        <input class="buttons" type="submit" value="Iniciar Sesión">


    </form>
</section>

</body>
</html>
