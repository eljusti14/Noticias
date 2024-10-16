<?php
require("../../../include/db.php");
include("../../../include/session_admin.php");
include("../../../include/botones/menu_admin.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="../../../styles/admin/crear_user.css">
</head>
<body>
    <div class="form-container">
        <h2>Crear Usuario</h2>

        <form method="POST" action="../../../controllers/user/insert.php">
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
            </div>
            <div>
                <label for="apellido">Apellido:</label>
                <input type="text" name="apellido" id="apellido" placeholder="Apellido" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Email" required>
            </div>
            <div>
                <label for="numero_celular">Número Celular:</label>
                <input type="text" name="numero_celular" id="numero_celular" placeholder="Teléfono" required>
            </div>
            <div>
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" placeholder="Contraseña" required>
            </div>
            <div>
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" required>
            </div>
            <?php
if (isset($_GET['error']) && $_GET['error'] == 1) {
    echo "<p style='color: red; text-align: center;'>Todos los campos son obligatorios. Por favor, complete todos los campos.</p>";
}
?>
            <input type="submit" value="Crear Usuario">
        </form>
        <a href="manage_users.php">Volver a la gestión de usuarios</a>
    </div>
</body>
</html>
