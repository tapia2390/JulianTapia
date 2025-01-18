// Selección de elementos del DOM
const form = document.querySelector('form');
const emailInput = document.querySelector('input[name="email"]');
const passwordInput = document.querySelector('input[name="password"]');
const errorMessage = document.getElementById('error-message');
const successMessage = document.getElementById('success-message');

// Función para mostrar mensaje de error
function showError(message) {
    errorMessage.style.display = 'block';
    errorMessage.textContent = message;
    successMessage.style.display = 'none';
}

// Función para mostrar mensaje de éxito
function showSuccess(message) {
    successMessage.style.display = 'block';
    successMessage.textContent = message;
    errorMessage.style.display = 'none';
}

// Evento de envío del formulario
form.addEventListener('submit', function (e) {
    e.preventDefault(); // Prevenir la acción predeterminada de enviar el formulario

    // Limpiar los mensajes antes de intentar hacer el login
    errorMessage.style.display = 'none';
    successMessage.style.display = 'none';

    // Obtener los valores del formulario
    const email = emailInput.value.trim();
    const password = passwordInput.value.trim();

    // Validación básica del formulario
    if (!email || !password) {
        showError("Por favor, ingresa tu correo y contraseña.");
        return;
    }

    // Aquí haríamos la validación AJAX hacia el servidor
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'ecomerce/php/login.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                showSuccess("¡Bienvenido de nuevo!");
                // Redirigir o hacer algo más en caso de éxito
                setTimeout(() => {
                    window.location.href = 'dashboard.html'; // Cambiar a la página principal o dashboard
                }, 1500); // Espera de 1.5 segundos para redirigir
            } else {
                showError(response.message || "Hubo un problema con el login.");
            }
        } else {
            showError("Hubo un error en la comunicación con el servidor.");
        }
    };

    // Enviar la solicitud AJAX con los datos del formulario
    xhr.send(`email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`);
});
