/*
document.addEventListener('DOMContentLoaded', function () {
  const nombreInput = document.getElementById('nombre');
  const apellidoInput = document.getElementById('apellido');
  const dniInput = document.getElementById('dni');
  const celularInput = document.getElementById('celular');

  // Función para limpiar caracteres no deseados
  function limpiarCaracteres(input) {
    input.value = input.value.replace(/[^A-Za-zÁáÉéÍíÓóÚú\s]/g, '');
  }

  // Función para limpiar caracteres no numéricos
  function PermitirSoloNumeros(input) {
    input.value = input.value.replace(/\D/g, '');
  }

  nombreInput.addEventListener('input', function () {
    limpiarCaracteres(nombreInput);
  });

  apellidoInput.addEventListener('input', function () {
    limpiarCaracteres(apellidoInput);
  });

  dniInput.addEventListener('input', function () {
    PermitirSoloNumeros(dniInput);
  });

  celularInput.addEventListener('input', function () {
    PermitirSoloNumeros(celularInput);
  });

});

// contraseñas registro
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('registroform');
  const passwordInput = document.getElementById('contrasena');
  const confirmPasswordInput = document.getElementById('contrasena_confirmacion');
  const passwordHelpInline = document.getElementById('passwordHelpInline');

  form.addEventListener('submit', function (event) {
    if (!validatePassword(passwordInput.value)) {
      passwordHelpInline.textContent = "La contraseña debe contener letras y números, mínimo 8 caracteres.";
      event.preventDefault(); // Evita que se envíe el formulario si la contraseña no es válida
    } else if (passwordInput.value !== confirmPasswordInput.value) {
      passwordHelpInline.textContent = "Las contraseñas no coinciden.";
      event.preventDefault(); // Evita que se envíe el formulario si las contraseñas no coinciden
    }
  });

  function validatePassword(password) {
    // Verifica que la contraseña contenga letras y números, mínimo 8 caracteres.
    const regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    return regex.test(password);
  }
});

//login
document.addEventListener('DOMContentLoaded', function () {
  const usernameInput = document.getElementById('username');

  usernameInput.addEventListener('input', function () {
    // Limpiar caracteres no numéricos
    usernameInput.value = usernameInput.value.replace(/\D/g, '');
  });
});

*/
















