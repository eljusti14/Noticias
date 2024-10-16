<?php
require_once("../../include/db.php");
include("../../include/session_cliente.php"); // Incluir el archivo que maneja la sesión
include("../../include/botones/menu2.php"); // Incluir el archivo que maneja la sesión

// Obtener el ID del usuario desde la sesión
$id_usuarios = $_SESSION['id_usuarios'];

// Consulta para obtener solo las noticias del usuario que ha iniciado sesión
$query = "SELECT noticias.id_noticias, noticias.titulo, noticias.descripcion, noticias.texto, categorias.nombre AS categoria, noticias.imagen 
          FROM noticias 
          JOIN categorias ON noticias.id_categorias = categorias.id_categorias
          WHERE noticias.id_usuarios = ?";

// Preparar la consulta
$stmt = $conx->prepare($query);
$stmt->bind_param("i", $id_usuarios); // Pasar el ID del usuario como parámetro
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias Recientes</title>
    <link rel="stylesheet" href="../../styles/cliente/gestion_noticias.css">

</head>
<body>
  <div class="titulo1">
    <h2>Tus noticias</h2>
  </div>

        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                    <th>Categoría</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php while($fila = $resultado->fetch_object()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($fila->titulo); ?></td>
                        <td><?php echo htmlspecialchars($fila->descripcion); ?></td>
                        <td>
                            <?php if (!empty($fila->imagen)) { ?>
                                <img src="../../../publico/imagenes<?php echo htmlspecialchars($fila->imagen); ?>" alt="Imagen de la noticia">
                            <?php } ?>
                        </td>
                        <td><?php echo htmlspecialchars($fila->categoria); ?></td>
                        <td class="actions">
                            <a href="editar.php?id_noticias=<?php echo $fila->id_noticias; ?>">Editar</a>
                        </td>
                        <td class="actions">
                            <a href="../../controllers/noticias/delete.php?id_noticias=<?php echo $fila->id_noticias; ?>" class="delete" onclick="return confirm('¿Está seguro que desea eliminar esta noticia?')">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>
