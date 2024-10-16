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

</body>  
</html>  
