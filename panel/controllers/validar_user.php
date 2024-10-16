<?php
require("../include/db.php");

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();  // Iniciar la sesión si no ha sido iniciada
}

// Recoger los datos enviados desde el formulario
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if (!empty($email) && !empty($password)) {
    // Preparar la consulta para verificar el email y la contraseña directamente en la base de datos
    $stmt = $conx->prepare("SELECT * FROM usuarios WHERE email = ? AND password = ? AND eliminado = 0");
    if ($stmt) {
        $stmt->bind_param("ss", $email, $password);  // Vinculamos tanto el email como la contraseña
        $stmt->execute();
        $resultado = $stmt->get_result();

        // Obtener los datos del usuario
        $usuario = $resultado->fetch_object();
        $stmt->close();

        if ($usuario) {
            // Si se encontró el usuario, iniciar la sesión y redirigir
            $_SESSION['id_usuarios'] = $usuario->id_usuarios;
            header("Location: ../views/cliente/gestion_noticias.php");
            exit;
        } else {
            // Credenciales incorrectas, redirigir con mensaje de error
            $error_message = ('Usuario y/o contraseña incorrectos');
            header("Location: ../login.php?error=" . $error_message);
            exit;
        }
    }
} else {
    // Si los campos están vacíos, redirigir con un mensaje de error
    $error_message = ('Por favor, rellena ambos campos');
    header("Location: ../login.php?error=" . $error_message);
    exit;
}
// Ejemplo de redirección si las credenciales son incorrectas
$error_message = ('Usuario y/o contraseña incorrectos');
header("Location: ../login.php?error=" . $error_message);
exit;
?>
