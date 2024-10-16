<?php
require_once("panel/include/db.php");
include("panel/include/botones/menu_noticias.php");

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start(); 
}

$query = "SELECT noticias.id_noticias, noticias.titulo, noticias.descripcion, noticias.texto, categorias.nombre AS categoria, noticias.imagen, noticias.fecha_creacion, usuarios.nombre AS creador
          FROM noticias 
          JOIN categorias ON noticias.id_categorias = categorias.id_categorias
          JOIN usuarios ON noticias.id_usuarios = usuarios.id_usuarios
          ORDER BY noticias.fecha_creacion DESC";

$resultado = $conx->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias Recientes</title>
 <link rel="stylesheet" href="panel/styles/noticias.css">
</head>
<body>

<div class="container">
    <div class="news-grid">
        <?php while($fila = $resultado->fetch_object()) { ?>
            <form action="detalles.php" method="POST" class="news-card">
                <input type="hidden" name="id_noticias" value="<?php echo $fila->id_noticias; ?>">
                <button type="submit" class="news-link">
                    <img src="panel/backend/uploads/<?php echo htmlspecialchars($fila->imagen); ?>" alt="Imagen de la noticia: <?php echo htmlspecialchars($fila->titulo); ?>">
                    <h2><?php echo htmlspecialchars($fila->titulo); ?></h2>
                    <span class="category"><?php echo htmlspecialchars($fila->categoria); ?></span>
                    <p class="fecha-creacion"><?php echo date("d M Y, H:i:s", strtotime($fila->fecha_creacion)); ?></p>
                </button>
            </form>
        <?php } ?>
    </div>
</div>

</body>
</html>
