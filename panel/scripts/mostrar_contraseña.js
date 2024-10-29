    // Seleccionar el input de contraseña y el icono
    const passwordInput = document.getElementById("password");
    const togglePasswordIcon = document.getElementById("togglePassword");

    // Evento click para alternar la visibilidad de la contraseña
    togglePasswordIcon.addEventListener("click", function() {
        // Alternar el tipo de input entre 'password' y 'text'
        const type = passwordInput.type === "password" ? "text" : "password";
        passwordInput.type = type;

        // Cambiar el ícono
        this.classList.toggle("bx-show-alt");
        this.classList.toggle("bx-hide");
    });