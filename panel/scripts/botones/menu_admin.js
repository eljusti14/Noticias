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