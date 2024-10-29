// Expresión regular para validar el email
function validarEmail(email) {
    const regexEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return regexEmail.test(email);
}

// Expresión regular para validar la contraseña
function validarContrasena(password) {
    const regexContrasena = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/; 
    return regexContrasena.test(password);
}

// Agregar el evento de submit al formulario
document.querySelector('form').addEventListener('submit', function(event) {
    const email = document.querySelector('#email').value;
    const password = document.querySelector('#password').value;
    const mensajeErrorEmail = document.querySelector('#error-email');
    const mensajeErrorPassword = document.querySelector('#error-password');

    // Limpiar mensajes de error previos
    mensajeErrorEmail.textContent = '';
    mensajeErrorPassword.textContent = '';

    let errorEncontrado = false;

    // Validar email
    if (!validarEmail(email)) {
        mensajeErrorEmail.textContent = 'Email no válido. Debe seguir el formato correcto, alguien@example.com .'; 
        document.querySelector('#email').focus();
        errorEncontrado = true;
    }

    // Validar contraseña (si se proporciona un nuevo valor)
    if (password && !validarContrasena(password)) {
        mensajeErrorPassword.textContent = 'La contraseña debe tener al menos una letra mayúscula, una letra minúscula y un número, y al menos 6 caracteres.'; 
        document.querySelector('#password').focus();
        errorEncontrado = true;
    }

    // Si hay errores, evitar el envío del formulario
    if (errorEncontrado) {
        event.preventDefault();
    }
});