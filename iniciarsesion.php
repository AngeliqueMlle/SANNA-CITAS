
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Iniciar sesión</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />

    <!-- Libraries Stylesheet -->
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet"> 
    <link rel="stylesheet" href="css/iniciarsesion.css"> 
    <!-- recaptcha de google-->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  
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
          <form action="controller/sesion_be.php" method="post" id="loginForm">
            <h2>Bienvenido</h2>
            <div class="imputbox">
                <label for="username" class="form-label">DNI</label>
                <input type="text" required class="form-control" id="username" name="username" placeholder="" minlength="8" maxlength="8">
              </div>
              <div class="imputbox">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" required class="form-control" id="password" name="password" placeholder="">
              </div>
              <div class="forget">
                <a href="dni.php">He olvidado mi contraseña</a>
              </div>
              <div class="g-recaptcha" data-sitekey="6LdE5GYoAAAAAM1a6TFwBIiIkaY2qFQFSD-XCj0z">
              </div>
              <div class="buttom">
                <input type="submit" class="btn btn-primary" value="Iniciar sesión" id="btnIniciarSesion">
              </div>
              <div class="register">
                <p>¿No tienes una cuenta? <a href="registrate.php">Regístrate</a></p>
              </div>           
          </form>
        </div>
      </div>
    </section>
    <div id="notification-container"></div>

    <!-- JavaScript Librerias -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>  
    
  </body>
</html>
