<?php
include("../../include/db.php");

if (isset($_GET['id_categorias'])) {
    $id_categoria = $_GET['id_categorias'];

    $sql_check_noticias = "SELECT COUNT(*) AS total FROM noticias WHERE id_categorias = ?";
    if ($stmt_check = $conx->prepare($sql_check_noticias)) {
        $stmt_check->bind_param("i", $id_categoria);
        $stmt_check->execute();
        $stmt_check->bind_result($total_noticias);
        $stmt_check->fetch();
        $stmt_check->close();

        if ($total_noticias > 0) {
            $error = "No se puede eliminar la categoría porque hay $total_noticias noticia(s) asociada(s).";
        } else {

            $sql_delete_categoria = "DELETE FROM categorias WHERE id_categorias = ?";
            if ($stmt_delete = $conx->prepare($sql_delete_categoria)) {
                $stmt_delete->bind_param("i", $id_categoria);
                if ($stmt_delete->execute()) {
                    header("Location: ../../views/admin/user/listado_categorias.php");
                    exit();
                } else {
                    $error = "Error al eliminar la categoría: " . $stmt_delete->error;
                }
                $stmt_delete->close();
            } else {
                $error = "Error al preparar la consulta: " . $conx->error;
            }
        }
    } else {
        $error = "Error al preparar la consulta para verificar noticias: " . $conx->error;
    }

    $conx->close();
} else {
    $error = "No se ha proporcionado un ID de categoría para eliminar.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error al eliminar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f0f0;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .error-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        .error-message {
            color: #e74c3c;
            font-size: 18px;
            margin-bottom: 20px;
        }
        .button {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <p class="error-message"><?php echo $error; ?></p>
        <a href="../../views/admin/user/listado_categorias.php" class="button">Volver a la lista de categorías</a>
    </div>
</body>
</html>
