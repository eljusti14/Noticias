<?php
require("../include/db.php");  // Conexión a la base de datos
// Iniciar la sesión si aún no se ha iniciado
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Obtener los valores del formulario
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Verificar que ambos campos no estén vacíos
if (!empty($email) && !empty($password)) {
    // Preparar la consulta SQL para buscar en la tabla 'administrador'
    $stmt = $conx->prepare("SELECT * FROM administrador WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);  // Vincular parámetros
    $stmt->execute();
    $resultado = $stmt->get_result();
    $stmt->close();

    $admin = $resultado->fetch_object();
    if ($admin === NULL) {
        // Si no se encuentra el administrador, mostrar un mensaje de error
        echo '<p style="color: red;">Usuario o contraseña incorrecto</p>';
    } else {
        // Si el administrador es válido, iniciar la sesión y redirigir al panel de administración
        $_SESSION['id_administrador'] = $admin->id_administrador;  // Almacenar el ID del administrador en la sesión
        header("Location: ../views/admin/dashboard.php");  // Redirigir al panel de administración
        exit();
    }
}
$error_message = ('Usuario y/o contraseña incorrectos');
header("Location: ../index.php?error=" . $error_message);
exit;
?>