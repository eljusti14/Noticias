<?php
include("../../include/db.php");

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el valor del input 'nombre_categoria'
    $nombre_categoria = isset($_POST['nombre_categoria']) ? trim($_POST['nombre_categoria']) : '';

    // Validar que el nombre de la categoría no esté vacío
    if (!empty($nombre_categoria)) {
        // Preparar la consulta SQL para insertar la nueva categoría (sin id_usuarios)
        $sql = "INSERT INTO categorias (nombre) VALUES (?)";

        // Preparar la sentencia
        if ($stmt = $conx->prepare($sql)) {
            // Bind del parámetro (nombre de la categoría)
            $stmt->bind_param("s", $nombre_categoria);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Redirigir al usuario a la lista de categorías después de un inserto exitoso
                header("Location: ../../views/admin/user/listado_categorias.php");
                exit();
            } else {
                // Redirigir con mensaje de error en la URL
                $error = "Error al insertar la categoría: " . $stmt->error;
                header("Location: ../../views/admin/user/crear_categorias.php?error=" . urlencode($error));
                exit();
            }

            // Cerrar la sentencia
            $stmt->close();
        } else {
            // Redirigir con mensaje de error en la URL si falla la preparación
            $error = "Error al preparar la consulta: " . $conx->error;
            header("Location: ../../views/admin/user/crear_categorias.php?error=" . urlencode($error));
            exit();
        }
    } else {
        // Mensaje de error si el campo está vacío
        $error = "El nombre de la categoría es obligatorio.";
        header("Location: ../../views/admin/user/crear_categorias.php?error=" . urlencode($error));
        exit();
    }

    // Cerrar la conexión
    $conx->close();
}
?>
