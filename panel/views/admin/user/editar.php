<?php
require_once("../../../include/db.php");
include("../../../include/session_admin.php");
include("../../../include/botones/menu_admin.php");

// Verificar si el parámetro id_usuarios está presente en la URL
if (isset($_GET['id_usuarios'])) {
    $id_usuarios = $_GET['id_usuarios'];

    // Preparar la consulta para obtener los datos del usuario
    $stmt = $conx->prepare("SELECT * FROM usuarios WHERE id_usuarios = ?");
    $stmt->bind_param("i", $id_usuarios);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuarios = $resultado->fetch_object();
    $stmt->close();

    // Verificar si el usuario existe
    if ($usuarios === null) {
        echo "No se encontró el usuario con el ID: $id_usuarios.";
        exit();
    }
} else {
    echo "Error: El parámetro 'id_usuarios' no está presente.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Editar Usuario</title>
    <link rel="stylesheet" href="../../../styles/admin/editar_user.css">

</head>
<body>
<div class="form-container">
    <h2 style="text-align: center;">Editar Usuario</h2>
    <form method="POST" action="../../../controllers/user/update.php">
    <input type="hidden" name="id_usuarios" value="<?php echo $usuarios->id_usuarios; ?>">

        <div>
            <label for="nombre">Nombre</label><br>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo htmlspecialchars($usuarios->nombre); ?>" required>
        </div><br>
        
        <div>
            <label for="apellido">Apellido</label><br>
            <input type="text" name="apellido" id="apellido" placeholder="Apellido" value="<?php echo htmlspecialchars($usuarios->apellido); ?>" required>
        </div><br>
        
        <div>
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email" placeholder="Email" value="<?php echo htmlspecialchars($usuarios->email); ?>" required>
            <div id="error-email" style="color: red;"></div>
        </div><br>
        
        <div>
            <label for="numero_celular">Número Celular</label><br>
            <input type="text" name="numero_celular" id="numero_celular" placeholder="Número Celular" value="<?php echo htmlspecialchars($usuarios->numero_celular); ?>" required>
        </div><br>

        <div class="password-container">
            <label for="password">Contraseña</label><br>
            <input class="controls" type="password" name="password" id="password" placeholder="Contraseña" value="<?php echo htmlspecialchars($usuarios->password); ?>" required>
            <i class='bx bx-show-alt' id="togglePassword"></i>
            <div id="error-password" style="color: red;"></div>
        </div><br>

        <div>
            <label for="fecha_nacimiento">Fecha de Nacimiento</label><br>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $usuarios->fecha_nacimiento; ?>" disabled>
        </div>
        <?php
    // Mostrar mensaje de error si está presente en la URL
    if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo "<p style='color: red; text-align: center;'>Error: Todos los campos deben ser completado correctamente.</p>";
    }
    ?>
        <input type="submit" value="Editar">
    </form>
    <a href="manage_users.php" class="back-button">Volver</a>
</div>
<script src="../../../scripts/expresiones_regulares/expresion_regular_editarUser.js"></script>
</body>
</html>
