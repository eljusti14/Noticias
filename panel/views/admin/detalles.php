<?php
require("../../include/db.php");
include("../../include/session_admin.php");
include("../../include/botones/menu_admin.php");

// Verificar si se ha pasado el ID de la noticia
if (isset($_GET['id_noticias'])) {
    $id_noticias = intval($_GET['id_noticias']); // Asegurarse de que es un entero

    // Realizar la consulta para obtener los detalles de la noticia junto con el nombre y apellido del usuario
    $query = "SELECT noticias.titulo, noticias.descripcion, noticias.texto, categorias.nombre AS categoria, noticias.imagen, usuarios.nombre AS nombre_usuario, usuarios.apellido
              FROM noticias 
              JOIN categorias ON noticias.id_categorias = categorias.id_categorias 
              JOIN usuarios ON noticias.id_usuarios = usuarios.id_usuarios
              WHERE noticias.id_noticias = ?";
    $stmt = $conx->prepare($query);
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
    <link rel="stylesheet" href="../../styles/admin/detalles.css">
 
</head>
<body>

<div class="container">
    <!-- Botón para volver -->
    <a href="dashboard.php" class="back-button">Volver</a>

    <!-- Categoría -->
    <div class="category"><?php echo htmlspecialchars($noticia->categoria); ?></div>

    <!-- Título -->
    <h1><?php echo htmlspecialchars($noticia->titulo); ?></h1>

    <!-- Subtítulo (Descripción) -->
    <h2><?php echo htmlspecialchars($noticia->descripcion); ?></h2>

    <!-- Imagen -->
    <img src="../../../publico/imagenes<?php echo htmlspecialchars($noticia->imagen); ?>" alt="Imagen de la noticia">

    <!-- Nombre del creador (Nombre y Apellido) -->
    <div class="creator">
        <strong>Creado por:</strong> <?php echo htmlspecialchars($noticia->nombre_usuario) ." ". htmlspecialchars($noticia->apellido); ?>
    </div>

    <!-- Texto de la noticia -->
    <div class="texto"><?php echo html_entity_decode($noticia->texto); ?></div>
</div>

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
