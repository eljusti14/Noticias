<?php
require_once("panel/include/db.php");

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start(); 
}

$valor_busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

// Parámetros para la paginación
$noticias_por_pagina = 10;
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_actual - 1) * $noticias_por_pagina;

// Consulta para contar el total de noticias (con o sin búsqueda)
$contar_query = "SELECT COUNT(*) as total FROM noticias";
if ($valor_busqueda) {
    $contar_query .= " WHERE titulo LIKE '%" . $conx->real_escape_string($valor_busqueda) . "%'";
}
$total_resultado = $conx->query($contar_query);
$total_filas = $total_resultado->fetch_object()->total;
$total_paginas = ceil($total_filas / $noticias_por_pagina);

// Consulta para obtener las noticias paginadas
$query = "SELECT noticias.id_noticias, noticias.titulo, noticias.descripcion, noticias.texto, categorias.nombre AS categoria, noticias.imagen, noticias.fecha_creacion, usuarios.nombre AS creador
          FROM noticias 
          JOIN categorias ON noticias.id_categorias = categorias.id_categorias
          JOIN usuarios ON noticias.id_usuarios = usuarios.id_usuarios";

if ($valor_busqueda) {
    $query .= " WHERE noticias.titulo LIKE '%" . $conx->real_escape_string($valor_busqueda) . "%'";
}
$query .= " ORDER BY noticias.fecha_creacion DESC LIMIT $offset, $noticias_por_pagina";

$resultado = $conx->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias Recientes</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #2e2828;
            padding: 5px;
            color: white;
            width: 100%;
            box-sizing: border-box;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
        }

        nav ul li {
            text-align: center;
        }

        nav a {
            text-decoration: none;
            display: block;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        nav a:hover {
            background-color: #ffffff;
            color: #000;
        }

        .search-bar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .search-bar input[type="text"] {
            padding: 8px;
            margin-right: 10px;
            border: none;
            border-radius: 5px;
            width: 200px;
        }

        .search-bar button {
            padding: 8px 15px;
            background-color: #5c5858;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }

        .search-bar button:hover {
            background-color: #e88d16;
        }

        .container {
            margin-top: 20px;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            padding: 20px;
        }

        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .news-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(235, 235, 235, 0.2);
            overflow: hidden;
            transition: transform 0.3s;
            width: 100%;
            max-width: 250px;
            height: 320px;
            position: relative;
            padding-bottom: 40px;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(54, 54, 54, 0.062);
        }

        .news-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .news-card h2 {
            font-size: 16px;
            margin: 10px 15px;
        }

        .category {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: rgba(59, 56, 56, 0.6);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
        }

        .news-card .fecha-creacion {
            position: absolute;
            bottom: 10px;
            left: 15px;
            font-size: 14px;
            color: gray;
        }

        .header {
            top: 0;
            left: 0;
            right: 0;
            background-color: #333;
            color: white;
            padding: 10px 20px;
            z-index: 1000;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .header a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            margin-left: 20px;
            transition: color 0.3s;
        }

        .header a:hover {
            color: #f1f1f1;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .pagination a {
            margin: 0 5px;
            text-decoration: none;
            color: #333;
            padding: 8px 12px;
            border-radius: 5px;
        }

        .pagination a.active {
            font-weight: bold;
            color: #000;
        }
    </style>
</head>
<body>

<nav>
    <ul>
        <li><a href="panel/login.php" target="_blank">Iniciar Sesion</a></li>
    </ul>

    <div class="search-bar">
        <form method="GET" action="">
            <input type="text" name="busqueda" placeholder="Buscar noticias..." id="searchInput" value="<?php echo htmlspecialchars($valor_busqueda); ?>">
            <button type="submit">Buscar</button>
        </form>
    </div>
</nav>

<div class="container">
    <div class="news-grid">
        <?php while($fila = $resultado->fetch_object()) { ?>
            <a href="detalles.php?id_noticias=<?php echo urlencode($fila->id_noticias); ?>" class="news-card">
                <img src="panel/backend/uploads/<?php echo htmlspecialchars($fila->imagen); ?>" alt="Imagen de la noticia: <?php echo htmlspecialchars($fila->titulo); ?>">
                <h2><?php echo htmlspecialchars($fila->titulo); ?></h2>
                <span class="category"><?php echo htmlspecialchars($fila->categoria); ?></span>
                <p class="fecha-creacion"><?php echo date("d M Y, H:i:s", strtotime($fila->fecha_creacion)); ?></p>
            </a>
        <?php } ?>
    </div>
    
    <!-- Paginación -->
    <div class="pagination">
        <?php if ($pagina_actual > 1): ?>
            <a href="?pagina=<?php echo $pagina_actual - 1; ?>&busqueda=<?php echo urlencode($valor_busqueda); ?>">Anterior</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
            <a href="?pagina=<?php echo $i; ?>&busqueda=<?php echo urlencode($valor_busqueda); ?>" <?php echo $i === $pagina_actual ? 'class="active"' : ''; ?>><?php echo $i; ?></a>
        <?php endfor; ?>

        <?php if ($pagina_actual < $total_paginas): ?>
            <a href="?pagina=<?php echo $pagina_actual + 1; ?>&busqueda=<?php echo urlencode($valor_busqueda); ?>">Siguiente</a>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
