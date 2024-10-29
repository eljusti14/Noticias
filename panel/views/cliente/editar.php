<?php
include("../../include/db.php");
include("../../include/session_cliente.php");
include("../../include/botones/menu2.php");

// Obtener el ID de la noticia desde la URL (GET)
$id_noticias = $_GET['id_noticias'];

// Preparar la consulta para obtener los datos de la noticia seleccionada
$query = "SELECT * FROM noticias WHERE id_noticias = ? AND id_usuarios = ?";
$stmt = $conx->prepare($query);
$stmt->bind_param("ii", $id_noticias, $_SESSION['id_usuarios']); // Asegurarse de que el ID del usuario sea el correcto
$stmt->execute();
$resultado = $stmt->get_result();

// Si no se encuentra la noticia
if ($resultado->num_rows == 0) {
    echo "Noticia no encontrada o no tiene permisos para editarla.";
    exit;
}

// Obtener la noticia
$noticia = $resultado->fetch_object();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Noticia</title>
    <link rel="stylesheet" href="../../styles/cliente/editar.css">

</head>
<body>
    <div class="form-container">
        <h2>Editar Noticia</h2>

        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>

        <form method="POST" action="../../controllers/noticias/update.php" enctype="multipart/form-data">
            <!-- Campo oculto para el ID de la noticia -->
            <input type="hidden" name="id_noticias" value="<?php echo $noticia->id_noticias; ?>">

            <!-- Campo oculto para el ID del usuario -->
            <input type="hidden" name="id_usuarios" value="<?php echo $noticia->id_usuarios; ?>">

            <!-- Campo oculto para la imagen actual -->
            <input type="hidden" name="imagen_actual" value="<?php echo htmlspecialchars($noticia->imagen); ?>">

            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($noticia->titulo); ?>" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required><?php echo htmlspecialchars($noticia->descripcion); ?></textarea>
            </div>

            <div class="form-group">
                <label for="texto">Texto completo:</label>
                <textarea id="texto" name="texto" required><?php echo htmlspecialchars($noticia->texto); ?></textarea>
            </div>

            <div class="form-group">
                <label for="id_categoria">Categoría:</label>
                <select id="id_categoria" name="id_categoria" required>
                    <option value="">Seleccione una categoría</option>
                    <?php
                    // Obtener las categorías
                    $stmt = $conx->prepare("SELECT * FROM categorias");
                    $stmt->execute();
                    $categorias = $stmt->get_result();
                    while ($cat = $categorias->fetch_object()) {
                        $selected = ($cat->id_categorias == $noticia->id_categorias) ? 'selected' : '';
                        echo "<option value='{$cat->id_categorias}' $selected>{$cat->nombre}</option>";
                    }
                    $stmt->close();
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="imagen">Imagen (opcional):</label>
                <input type="file" id="imagen" name="imagen">
            </div>

            <button type="submit">Actualizar</button>
        </form>
    </div>

    <script src="https://cdn.tiny.cloud/1/s8nis6wm14py0d2i0yl5gbzpi95a6qro2hh9r44g80029vjm/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> 

<script>
// Inicializar TinyMCE
tinymce.init({
    selector: '#texto', // Asegúrate de que el ID coincida
    menubar: false, // Opcional: ocultar el menú superior
    plugins: 'link image code', // Configuración básica
    toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | code', // Barra de herramientas básica
    setup: function(editor) {
        // Sincronizar el contenido de TinyMCE con el textarea antes de enviar el formulario
        editor.on('change', function() {
            tinymce.triggerSave();
        });
    }
});
</script>
</body>
</html>