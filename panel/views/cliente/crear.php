<?php  
// Incluir la conexión a la base de datos  
require("../../include/db.php");  
include("../../include/session_cliente.php");
include("../../include/botones/menu2.php");

// Recuperar el id_usuarios de la sesión
$id_usuarios = $_SESSION['id_usuarios'];  

// Consultar las categorías
$categorias = $conx->query("SELECT * FROM categorias");  

// Obtener los datos del usuario
$stmt = $conx->prepare("SELECT * FROM usuarios WHERE id_usuarios = ?");  
$stmt->bind_param("i", $id_usuarios);  
$stmt->execute();  
$resultado = $stmt->get_result();  
$usuarios = $resultado->fetch_object();  
$stmt->close();  
?>  

<!DOCTYPE html>  
<html lang="es">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Crear Noticia</title>  
    <link rel="stylesheet" href="../../styles/cliente/crear.css">
</head>  
<body>  
    <div class="form-container">
        <h2>Crear Nueva Noticia</h2>  

        <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>  

        <form method="POST" action="../../controllers/noticias/insert.php" enctype="multipart/form-data">  
            <input type="hidden" name="id_usuarios" value="<?php echo isset($usuarios) ? $usuarios->id_usuarios : ''; ?>">  
            <div>  
                <label for="titulo">Título:</label>  
                <input type="text" id="titulo" name="titulo" required>  
            </div><br>  

            <div>  
                <label for="descripcion">Descripción:</label>  
                <textarea id="descripcion" name="descripcion" required></textarea>  
            </div><br>  

            <div>  
                <label for="texto">Texto completo:</label>  
                <textarea id="texto" name="texto" required></textarea>  
            </div><br>  

            <div>  
                <label for="id_categoria">Categoría:</label>  
                <select id="id_categoria" name="id_categoria" required>  
                    <option value="">Seleccione una categoría</option>  
                    <?php while($cat = $categorias->fetch_object()): ?>  
                        <option value="<?= $cat->id_categorias ?>"><?= $cat->nombre ?></option>  
                    <?php endwhile; ?>  
                </select>  
            </div><br>  

            <div>  
                <label for="imagen">Imagen (opcional):</label>  
                <input type="file" id="imagen" name="imagen">  
            </div><br>  

            <button type="submit">Crear Noticia</button>  
        </form>  

        <a href="gestion_noticias.php">Volver al Listado de Noticias</a>  
    </div>
    
    <!-- Cargar TinyMCE al final del body -->
    <script src="https://cdn.tiny.cloud/1/s8nis6wm14py0d2i0yl5gbzpi95a6qro2hh9r44g80029vjm/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> 

<script>
  tinymce.init({
    selector: '#texto', // Asegúrate de que el ID coincida
    menubar: true, // Mostrar la barra de menú completa
    plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table paste help wordcount', // Agregar más plugins
    toolbar: 'undo redo | formatselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | code fullscreen preview', // Herramientas mejoradas
    toolbar_sticky: true, // Mantener la barra de herramientas visible al desplazarse
    image_advtab: true, // Permitir la configuración avanzada de imágenes
    content_css: '//www.tiny.cloud/css/codepen.min.css', // Estilos
    height: 400, // Aumentar el tamaño del editor
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
