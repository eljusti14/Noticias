<?php
session_start(); // Iniciar la sesión
if (!isset($_SESSION['id_administrador'])) {
    header("Location: ../../"); // Redirigir si no está logueado
    exit();
}
?>
