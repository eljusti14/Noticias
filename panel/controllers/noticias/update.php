<?php
require("../../include/db.php");
include("../../include/session_cliente.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_noticias = $_POST['id_noticias']; 
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $texto = $_POST['texto'];
    $id_categoria = $_POST['id_categoria'];
    $id_usuario = $_SESSION['id_usuarios']; 

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
        $imagen_tmp = $_FILES['imagen']['tmp_name'];
        $imagen_nombre = basename($_FILES['imagen']['name']); // Nombre del archivo
        $ruta_imagen = '../../../publico/imagenes/' . $imagen_nombre; // Ruta donde se guardará la imagen

        if (move_uploaded_file($imagen_tmp, $ruta_imagen)) {
            echo "Imagen subida correctamente.";
        } else {
            echo "Error al mover la imagen a la carpeta de destino.";
        }
    } else {
        $ruta_imagen = $_POST['imagen_actual']; // Usamos la imagen que ya estaba en la base de datos
    }

    // Preparar la consulta para actualizar la noticia
    if (!empty($ruta_imagen)) {
        // Si se ha subido una nueva imagen, actualizamos con la nueva imagen
        $stmt = $conx->prepare("UPDATE noticias SET titulo = ?, descripcion = ?, texto = ?, id_categorias = ?, id_usuarios = ?, imagen = ?, fecha_creacion = NOW() WHERE id_noticias = ?");
        $stmt->bind_param("ssssssi", $titulo, $descripcion, $texto, $id_categoria, $id_usuario, $ruta_imagen, $id_noticias);
    } else {
        // Si no se ha subido una nueva imagen, actualizamos sin cambiar la imagen
        $stmt = $conx->prepare("UPDATE noticias SET titulo = ?, descripcion = ?, texto = ?, id_categorias = ?, id_usuarios = ?, fecha_creacion = NOW() WHERE id_noticias = ?");
        $stmt->bind_param("sssssi", $titulo, $descripcion, $texto, $id_categoria, $id_usuario, $id_noticias);
    }

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Redireccionar a la página de listado de noticias
        header("Location: ../../views/cliente/gestion_noticias.php");
        exit; // Asegurarse de que el script se detenga después de la redirección
    } else {
        echo "Error al actualizar la noticia: " . $stmt->error;
    }

    // Cerrar la declaración
    $stmt->close();
}

// Cerrar la conexión
$conx->close();
?>
