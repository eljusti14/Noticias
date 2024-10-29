<?php
require_once("panel/include/db.php");

if (isset($_GET['id_noticias'])) {
    $id_noticias = intval($_GET['id_noticias']); 
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
    <style>      
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 0;
            padding-top: 50px;
        }

        .container {
            max-width: 1100px;
            margin: 60px auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            position: relative;
            transition: all 0.3s ease;
        }

        .container:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .back-button {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #555;
        }

        .container img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            margin: 20px 0;
            display: block;
            margin-left: auto;
            margin-right: auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 36px;
            color: #222;
            margin-bottom: 20px;
            font-weight: bold;
            text-align: center;
            letter-spacing: 1px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .category {
            display: inline-block;
            background-color: #007BFF;
            color: white;
            padding: 6px 14px;
            font-size: 14px;
            border-radius: 20px;
            position: absolute;
            top: 20px;
            left: 20px;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        h2 {
            font-size: 22px;
            color: #555;
            margin-bottom: 20px;
            text-align: center;
        }

        .description {
            font-size: 20px;
            color: #666;
            margin-bottom: 20px;
            text-align: center;
            line-height: 1.6;
        }

        .texto {
            font-size: 18px;
            line-height: 1.8;
            color: #444;
            margin-bottom: 30px;
            text-align: justify;
            word-spacing: 1px;
        }

        .creator {
            font-size: 16px;
            color: #444;
            margin-top: 30px;
            text-align: center;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            font-weight: bold;
        }

        .creator strong {
            color: #007BFF;
        }
    </style>
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
