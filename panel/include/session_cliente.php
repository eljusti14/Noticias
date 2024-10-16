<?php
session_start(); // Iniciar la sesión
if (!isset($_SESSION['id_usuarios'])) {
    header("Location: ../../login"); // Redirigir si no está logueado
    exit();
}
?>
