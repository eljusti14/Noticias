<?php
require("../../../include/db.php");  
include("../../../include/session_admin.php");
include("../../../include/botones/menu_admin.php");

$resultado = $conx->query("SELECT * FROM categorias");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Categorías</title>
    <link rel="stylesheet" href="../../../styles/admin/listado_categorias.css">

</head>
<body>
    <div class="categorias_container">
        <h2 class="categorias_title">Listado de Categorías</h2>

        <table class="categorias_table">
            <thead>
                <tr>
                    <th>Nombre de la Categoría</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php while($fila = $resultado->fetch_object()) { ?>
                    <tr>
                        <td><?php echo $fila->nombre; ?></td>
                        <td class="categorias_actions">
                            <a href="../../../controllers/noticias/delete_categorias.php?id_categorias=<?php echo $fila->id_categorias; ?>" class="btn-eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar esta categoría?');">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="crear_categorias.php" class="categorias-btn-crear">Crear Nueva Categoría</a>
        <a href="crear_categorias.php" class="categorias-btn-crear">Volver</a>
    </div>
</body>
</html>
