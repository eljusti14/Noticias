<?php  
require("../../include/db.php");  
include("../../session_cliente.php");  

if (isset($_GET['id_noticias'])) {
    $id_noticias = $_GET['id_noticias'];

    $stmt = $conx->prepare("DELETE FROM noticias WHERE id_noticias = ?");
    $stmt->bind_param("i", $id_noticias);  

    if ($stmt->execute()) {
        header("Location: ../../views/cliente/gestion_noticias.php");
        exit;  
    } else {
        echo "Error al eliminar la noticia: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No se ha proporcionado el ID de la noticia.";
}

$conx->close();
?>
