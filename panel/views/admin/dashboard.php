<?php 
include("../../include/db.php");
include("../../include/session_admin.php");
include("../../include/botones/menu_admin.php");

$resultado = $conx->query("
    SELECT noticias.id_noticias, noticias.titulo, noticias.descripcion, noticias.texto, 
           categorias.nombre AS categoria, noticias.imagen, 
           usuarios.nombre AS nombre_usuario, usuarios.apellido AS apellido_usuario
    FROM noticias
    JOIN categorias ON noticias.id_categorias = categorias.id_categorias
    JOIN usuarios ON noticias.id_usuarios = usuarios.id_usuarios
    ORDER BY noticias.id_noticias DESC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de control</title>
    <link rel="stylesheet" href="../../styles/admin/dashboard.css">
</head>
<body>
<div class="container">
    <h1 class="title">Administarcion de noticias</h1>
    
    <fieldset class="custom-fieldset">
        <legend>Últimas noticias</legend>
        <div class="news-grid">
    <?php while($fila = $resultado->fetch_object()) { ?>
        <div class="news-card" onclick="window.location.href='detalles.php?id_noticias=<?php echo $fila->id_noticias; ?>'">
            <img src="../../../publico/imagenes<?php echo htmlspecialchars($fila->imagen); ?>" alt="Imagen de la noticia: <?php echo htmlspecialchars($fila->titulo); ?>">
            <h2><?php echo htmlspecialchars($fila->titulo); ?></h2>
            <span class="category"><?php echo htmlspecialchars($fila->categoria); ?></span>
            <p class="author">Por: <?php echo htmlspecialchars($fila->nombre_usuario) . ' ' . htmlspecialchars($fila->apellido_usuario); ?></p>
            
            <!-- Contenedor de los botones de acción -->
            <div class="action-buttons">
                <a href="../../controllers/noticias/delete_admin.php?id_noticias=<?php echo $fila->id_noticias; ?>" class="delete-button" title="Borrar">Borrar</a>
            </div>
        </div>
    <?php } ?>
</div>

        </div>
    </fieldset>
</div>

</body>
</html>
