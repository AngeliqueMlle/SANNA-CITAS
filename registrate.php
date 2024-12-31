<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registrate</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

  <!-- Libraries Stylesheet -->
  <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

  <!-- flatpickr -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">

  <!-- Template Stylesheet -->
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="css/registrate.css">

</head>

<body>

  <!-- Spinner Start -->
  <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>
  <!-- Spinner End -->

  <section>
    <div class="form-box">
      <div class="form-value">
        <form id="formRegistraUsuario" action="controller/registra_usuario_be.php" method="post" class="needs-validation" novalidate>
          <h5>Ingresar datos personales</h5> <br>
          <div class="row">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" required class="form-control" id="nombres" name="nombresUsuario" placeholder="Nombre(s)" pattern=".*\S+.*">
                <label for="nombres">Nombre(s)</label>
              </div>
              <div class="form-floating">
                <input type="text" required class="form-control" id="apellidos" name="apellidosUsuario" placeholder="Apellidos" pattern=".*\S+.*">
                <label for="apellidos">Apellidos</label>
              </div>
              <div class="form-floating">
                <input type="text" required class="form-control" id="dni" name="dniUsuario" placeholder="Nº de documento" pattern="[0-9]{8}" maxlength="8">
                <label for="dni">Nº de documento</label>
                <div class="invalid-feedback">
                  Ingrese un DNI válido.
                </div>
              </div>
              <div class="form-floating">
                <input type="email" required class="form-control" id="correo" name="correoUsuario" placeholder="Correo electrónico" aria-describedby="inputGroupPrepend">
                <label for="correo">Correo electrónico</label>
                <div class="invalid-feedback">
                  Ingrese un correo válido.
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="tel" required class="form-control" id="celular" name="celularUsuario" placeholder="Celular" pattern="[0-9]{9}" maxlength="9">
                <label for="celular">Celular</label>
                <div class="invalid-feedback">
                  Ingrese un número válido.
                </div>
              </div>
              <div class="form-floating">
                <input type="date" required class="form-control" placeholder="Fecha de nacimiento" id="fechaNacimiento" name="fechaNacimiento" title="Debe ser mayor de edad">
                <label for="fechaNacimiento">Fecha de Nacimiento</label>
              </div>
              <div class="form-floating">
                <input type="password" required class="form-control" id="contrasena" name="contrasenaUsuario" placeholder="Contraseña" pattern="^(?=.*[A-Za-z])(?=.*\d).{8,}$" title="Debe contener al menos 1 letra, 1 número y tener una longitud mínima de 8 caracteres.">
                <label for="contrasena">Contraseña</label>
              </div>
              <div class="form-floating">
                <input type="password" required class="form-control" id="confcontrasena" name="contrasenaConfUsuario" placeholder="Confirmar contraseña" pattern="^(?=.*[A-Za-z])(?=.*\d).{8,}$" title="Debe contener al menos 1 letra, 1 número y tener una longitud mínima de 8 caracteres.">
                <label for="confcontrasena">Confirmar Contraseña</label>
                <div id="message"></div>
              </div>
            </div>
          </div>
          <br>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
              Acepto recibir beneficios, ofertas, publicidad y novedades de Clinica San Borja (opcional)
            </label>
          </div>
          <div class="form-check">
            <input required class="form-check-input" type="checkbox" value="" id="invalidCheck">
            <label class="form-check-label" for="invalidCheck">
              He leído y estoy de acuerdo con los
              <a href="https://drive.google.com/file/d/1G5lUjKexVBrlRi9FXkDMYDnNlx6rNGCI/view?usp=sharing" target="_blank">Términos y Condiciones. </a>
              <a href="https://drive.google.com/file/d/1E5s0Jo6YGypJm1etkPGqMBOsZYfuB4BW/view?usp=sharing" target="_blank">Políticas de privacidad</a>
            </label>
          </div>
          <div class="buttom">
            <input type="submit" class="btn btn-primary" value="Finalizar Registro">
          </div>
        </form>
      </div>
    </div>
  </section>
  <!-- JavaScript Librerias -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/counterup/counterup.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>

  <!-- Template Javascript -->
  <script src="js/main.js"></script>
  <script src="js/registrarte.js"></script>
  <script src="lib/tempusdominus/js/moment.min.js"></script>
  <!-- flatpickr -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <script src="js/flatpickr.js"></script>
</body>

</html>