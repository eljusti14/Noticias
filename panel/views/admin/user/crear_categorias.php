<?php
include("../../../include/db.php");
include("../../../include/session_admin.php");
include("../../../include/botones/menu_admin.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Categoría</title>
<link rel="stylesheet" href="../../../styles/admin/crear_categorias.css">
</head>
<body>
    <div class="container">
        <h2 class="title">Crear Nueva Categoría</h2>

        <?php
        if (isset($_GET['error'])) {
            echo "<p class='error-message'>" . htmlspecialchars($_GET['error']) . "</p>";
        }
        ?>

        <form method="POST" action="../../../controllers/noticias/insert_categorias.php" class="category-form">
            <div class="input-group">
                <label for="nombre_categoria" class="label">Nombre de la Categoría:</label>
                <input type="text" id="nombre_categoria" name="nombre_categoria" class="input-field" required>
            </div>

            <button type="submit" class="submit-button">Crear Categoría</button>
        </form>

        <a href="listado_categorias.php" class="link">Ver Categorías</a>
    </div>
</body>
</html>
