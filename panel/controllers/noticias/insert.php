<?php  
require("../../include/db.php");  
include("../../session_cliente.php");  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
    $titulo = $_POST['titulo'];  
    $descripcion = $_POST['descripcion'];  
    $texto = $_POST['texto'];  
    $id_categoria = $_POST['id_categoria'];  
    $id_usuario = $_POST['id_usuarios'];

    // Manejo de la imagen  
    $imagen = null;  
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {  
        // Obtener información del archivo subido
        $imagen_tmp = $_FILES['imagen']['tmp_name'];  
        $imagen_nombre = basename($_FILES['imagen']['name']); // Nombre del archivo  
        $ruta_imagen = '../../../publico/imagenes/' . $imagen_nombre; // Ruta donde se guardará la imagen

        // Mover el archivo de la carpeta temporal a la carpeta de destino
        if (move_uploaded_file($imagen_tmp, $ruta_imagen)) {
            echo "Imagen subida correctamente.";
        } else {
            echo "Error al mover la imagen a la carpeta de destino.";
        }
    }

    $stmt = $conx->prepare("INSERT INTO noticias (titulo, descripcion, texto, id_categorias, id_usuarios, imagen, fecha_creacion) VALUES (?, ?, ?, ?, ?, ?, NOW())");  
    $stmt->bind_param("ssssss", $titulo, $descripcion, $texto, $id_categoria, $id_usuario, $ruta_imagen);  

    // Ejecutar la consulta  
    if ($stmt->execute()) {  
        header("Location: ../../views/cliente/gestion_noticias.php");  
        exit; // Asegurarse de que el script se detenga después de la redirección
    } else {  
        echo "Error al crear la noticia: " . $stmt->error;  
    }  

    $stmt->close();  
}  

$conx->close();  
?>
