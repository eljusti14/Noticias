<?php
require_once("panel/include/db.php");
include("panel/include/botones/menu_noticias.php");

if (isset($_POST['id_noticias'])) {
    $id_noticias = intval($_POST['id_noticias']); 
 // CONSULTA
    $stmt = $conx->prepare("SELECT noticias.titulo, noticias.descripcion, noticias.texto, categorias.nombre AS categoria, noticias.imagen, usuarios.nombre AS nombre_usuario, usuarios.apellido
              FROM noticias 
              JOIN categorias ON noticias.id_categorias = categorias.id_categorias 
              JOIN usuarios ON noticias.id_usuarios = usuarios.id_usuarios
              WHERE noticias.id_noticias = ?");
    $stmt->bind_param("i", $id_noticias);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $noticia = $resultado->fetch_object();

    if ($noticia) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($noticia->titulo); ?></title>
    <link rel="stylesheet" href="panel/styles/detalles.css">
</head>
<body>

<div class="container">
            <a href="index.php" class="back-button">Volver</a>
        <div class="category"><?php echo htmlspecialchars($noticia->categoria); ?></div>
            <h1><?php echo htmlspecialchars($noticia->titulo); ?></h1>
            <h2><?php echo htmlspecialchars($noticia->descripcion); ?></h2>
            <img src="panel/backend/uploads/<?php echo htmlspecialchars($noticia->imagen); ?>" alt="Imagen de la noticia">
        <div class="creator">
            <strong>Creado por:</strong> <?php echo htmlspecialchars($noticia->nombre_usuario) ." ". htmlspecialchars($noticia->apellido); ?>
        </div>
       <div class="texto"><?php echo nl2br(htmlspecialchars($noticia->texto)); ?></div>
    </body>
</html>
<?php
    } else {
        echo "<p>Noticia no encontrada.</p>";
    }
} else {
    echo "<p>ID de noticia no especificado.</p>";
}
?>
