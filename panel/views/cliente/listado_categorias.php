<?php
require("../../include/db.php");  
include("../../include/session_cliente.php");
include("../../include/botones/menu2.php");

$resultado = $conx->query("SELECT * FROM categorias");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Categorías</title>
    <link rel="stylesheet" href="../../styles/cliente/listado_categorias.css">

</head>
<body class="body-categorias">
    <div class="container-categorias">
        <h2 class="titulo-categorias">Listado de Categorías</h2>

        <table class="tabla-categorias">
            <thead>
                <tr>
                    <th>Nombre de la Categoría</th>
                </tr>
            </thead>
            <tbody>
                <?php while($fila = $resultado->fetch_object()) { ?>
                    <tr>
                        <td><?php echo $fila->nombre; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
