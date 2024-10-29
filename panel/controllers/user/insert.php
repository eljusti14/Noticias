<?php
require("../../include/db.php");
include("../../session_cliente.php");

$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : ''; // Usar trim para eliminar espacios en blanco
$apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : '';
$dni = isset($_POST['dni']) ? trim($_POST['dni']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$numero_celular = isset($_POST['numero_celular']) ? trim($_POST['numero_celular']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';
$fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? trim($_POST['fecha_nacimiento']) : '';

if (empty($nombre) || empty($apellido) || empty($dni) || empty($email) || empty($numero_celular) || empty($password) || empty($fecha_nacimiento)) {
    header("Location: ../../views/admin/user/crear_user.php?error=1");
    exit(); 
}

$stmt = $conx->prepare("INSERT INTO usuarios (nombre, apellido, dni, email, numero_celular, password, fecha_nacimiento) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $nombre, $apellido, $dni, $email, $numero_celular, $password, $fecha_nacimiento);
$stmt->execute();
$stmt->close();

header("Location: ../../views/admin/user/manage_users.php");
die();
?>
