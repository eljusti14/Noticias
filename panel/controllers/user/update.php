<?php
require("../../include/db.php");
include("../../session_cliente.php");
// trim para limiar espacio
$id_usuarios = $_POST['id_usuarios'];
$nombre = trim($_POST['nombre']); 
$apellido = trim($_POST['apellido']); 
$email = trim($_POST['email']); 
$numero_celular = trim($_POST['numero_celular']); 
$password = trim($_POST['password']); 

if (empty($nombre) || empty($apellido) || empty($email) || empty($numero_celular) || empty($password) || $numero_celular == "0") {
    header("Location: ../../views/admin/user/editar.php?id_usuarios=$id_usuarios&error=1");
    exit(); 
}

$stmt = $conx->prepare("UPDATE usuarios SET nombre = ?, apellido = ?, email = ?, numero_celular = ?, password = ? WHERE id_usuarios = ?");
$stmt->bind_param("sssssi", $nombre, $apellido, $email, $numero_celular, $password, $id_usuarios);
$stmt->execute();
$stmt->close();

header("Location: ../../views/admin/user/manage_users.php");
die();
?>
