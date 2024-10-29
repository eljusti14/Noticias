<?php
// Comprobar si hay un mensaje de error en la URL
$error_message = isset($_GET['error']) ? $_GET['error'] : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styles/admin/index.css">
    <title>Panel de control</title>
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
        <div class="password-container">
            <input class="controls" type="password" name="password" id="password" placeholder="Contraseña" required>
            <i class='bx bx-show-alt' id="togglePassword"></i>
        </div>
        <input class="buttons" type="submit" value="Iniciar Sesión">
    </form>
</section>
<script src="scripts/mostrar_contraseña.js"></script>
</body>
</html>