<?php
include("../../include/db.php");
include("../../include/session_admin.php");
$id_usuarios = $_GET['id_usuarios'];
$stmt = $conx->prepare("UPDATE usuarios SET eliminado = 1 WHERE id_usuarios = ?");
$stmt->bind_param("i", $id_usuarios);
$stmt->execute();
$stmt->close();
header("Location: ../../views/admin/user/manage_users.php");
die();

?>
