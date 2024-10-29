<?php
define('BASE_URL', 'http://localhost/programacion/Noticias/panel');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Lateral Desplegable</title>
<style>
          .menu-lateral {
        height: 100%;
        width: 200px; /* Ancho del menú */
        position: fixed;
        top: 0;
        left: -200px; /* Oculto inicialmente */
        background-color: #c4bbbb;
        overflow-x: hidden;
        transition: left 0.3s ease; /* Animación para abrir/cerrar el menú */
        padding-top: 20px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        z-index: 1000; /* Asegura que el menú esté por encima del contenido */
    }
   /* Estilo para los enlaces del menú */
   .menu-lateral a {
    padding: 8px 8px 8px 20px; /* Reduce el espacio interior */
    text-decoration: none;
    font-size: 20px; /* Texto más pequeño */
    color: #000000;
    display: block;
    transition: 0.3s;
 }

 .menu-lateral a:hover {
    color: #ffffff;
 }

  /* Botón para cerrar el menú */
  .cerrar-btn {
    position: absolute;
    top: 0;
    right: 20px; /* Ajusta la posición al nuevo ancho del menú */
    font-size: 30px; /* Tamaño de fuente más pequeño */
    color: #000000;
    margin-left: 30px;
 }

 /* Botón "Cerrar Sesión" */
 .menu-lateral .cerrar-sesion {
    margin-top: 40px; /* Ajusta el margen superior para colocarlo más arriba */
    padding: 8px 8px 8px 20px;
    font-size: 20px;
    color: #000000;
    display: block;
    text-decoration: none;
    text-align: center;
 }

 .menu-lateral .cerrar-sesion:hover {
    color: #f1f1f1;
 }

 /* Estilos para el botón de abrir el menú */
 .abrir-btn {
    font-size: 20px; /* Tamaño de fuente más pequeño */
    cursor: pointer;
    background-color: #111;
    color: white;
    border: none;
    padding: 5px; /* Reduce el tamaño del botón */
    display: block;
    position: absolute;
    top: 20px;
    left: 10px; /* Ajusta la posición del botón */
 }

 /* Estilo para el contenedor de contenido principal */
 #contenido {
    transition: margin-left 0.3s ease; /* Animación para mover el contenido */
 }
</style>

</head>
<body>

    <div id="contenido">
        <button class="abrir-btn" onclick="abrirMenu()">☰ Menú</button>

        <!-- Menú lateral -->
        <div id="menuLateral" class="menu-lateral">
            <a href="javascript:void(0)" class="cerrar-btn" onclick="cerrarMenu()">×</a>
            <!-- Uso de rutas absolutas con la constante BASE_URL -->
            <a href="<?php echo BASE_URL; ?>/views/admin/dashboard.php">Inicio</a>
            <a href="<?php echo BASE_URL; ?>/views/admin/user/manage_users.php">Gestionar Usuarios</a>
            <a href="<?php echo BASE_URL; ?>/views/admin/user/listado_categorias.php">Gestionar categorias</a>
            <a href="<?php echo BASE_URL; ?>/include/cerrar_session_admin.php" class="cerrar-sesion">Cerrar Sesión</a>
 
        </div>
    </div>
<script >
           // Función para abrir el menú lateral
           function abrirMenu() {
        document.getElementById("menuLateral").style.left = "0";  // Desplaza el menú hacia la derecha
        document.getElementById("contenido").style.marginLeft = "250px";  // Desplaza el contenido hacia la derecha
      }

      // Función para cerrar el menú lateral
      function cerrarMenu() {
        document.getElementById("menuLateral").style.left = "-250px";  // Restaura el menú fuera de la vista
        document.getElementById("contenido").style.marginLeft = "0";  // Restaura el contenido
      }
</script>

</body>
</html>
