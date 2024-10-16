<?php ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Noticias</title>
    <link rel="stylesheet" href="css/main.css">
<style>/* Colores */
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
  width: 100%; /* Asegura que ocupe todo el ancho de la pantalla */
  box-sizing: border-box; /* Para que el padding no afecte el tamaño total */
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

 /* Barra de búsqueda */
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
</style>
  </head>
  <body>
    <!-- Barra de navegación -->
    <nav>
      <ul>
        <li><a href="panel/login.php" target="_blank">Iniciar Sesion</a></li>
      </ul>

      <!-- Barra de búsqueda -->
      <div class="search-bar">
        <input type="text" placeholder="Buscar noticias..." id="searchInput">
        <button onclick="searchNews()">Buscar</button>
      </div>
    </nav>

    <script>
      // Función de búsqueda (solo para simular la búsqueda)
      function searchNews() {
        const query = document.getElementById("searchInput").value;
        alert("Buscando noticias sobre: " + query);
      }
    </script>
  </body>
</html>
