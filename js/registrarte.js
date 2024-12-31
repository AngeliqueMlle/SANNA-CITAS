// bootstrap validacion
(() => {
  "use strict";
  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll(".needs-validation");
  // Loop over them and prevent submission
  Array.from(forms).forEach((form) => {
    form.addEventListener(
      "submit",
      (event) => {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add("was-validated");
      },
      false
    );
  });
})();

document.addEventListener("DOMContentLoaded", function () {
  const passwordInput = document.getElementById("contrasena");
  const confirmPasswordInput = document.getElementById("confcontrasena");
  const message = document.getElementById("message");
  confirmPasswordInput.addEventListener("input", function () {
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;
    // validacion en tiempo real para verificar la igualdad de contraseñas
    if (password === confirmPassword) {
      message.textContent = "";
    } else {
      message.textContent = "Las contraseñas no coinciden.";
      message.classList.remove("text-success");
      message.classList.add("text-danger");
    }
  });
  // no se envia el formulario si las contraseñas son invalidas
  const form = document.getElementById("formRegistraUsuario");
  form.addEventListener("submit", function (e) {
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;

    if (
      password !== confirmPassword ||
      !/^(?=.*[A-Za-z])(?=.*\d).{8,}$/.test(password)
    ) {
      e.preventDefault();
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  // Función para limpiar caracteres no deseados o no numéricos
  function limpiarCampo(input, regex) {
    input.addEventListener("input", function () {
      input.value = input.value.replace(regex, "");
      input.value = input.value.toUpperCase();
    });
  }
  // Llamadas a la función para cada campo
  const nombreInput = document.getElementById("nombres");
  limpiarCampo(nombreInput, /[^A-Za-zÁáÉéÍíÓóÚú\s]/g);

  const apellidoInput = document.getElementById("apellidos");
  limpiarCampo(apellidoInput, /[^A-Za-zÁáÉéÍíÓóÚú\s]/g);

  const dniInput = document.getElementById("dni");
  limpiarCampo(dniInput, /\D/g);

  const celularInput = document.getElementById("celular");
  celularInput.addEventListener("input", function () {
    let value = celularInput.value;
    // Si el valor no comienza con "9", borrarlo
    if (!/^9\d{0,8}$/.test(value)) {
      celularInput.value = "";
    }
  });
}); 











