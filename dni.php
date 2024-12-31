<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registrate</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    
    <!-- Template   Stylesheet -->
    <link href="css/estilos.css" rel="stylesheet">

  </head>
    <body>
      
      <section>
        <div class="formulario">
          <h2>Olvidé mi contraseña</h2>
          <form action="controller/verificar_dni_be.php" method="post">
              <label for="dni">Ingrese su DNI afiliado (8 dígitos numéricos)</label>
              <input type="text" id="dni_recuperar" name="dni" required pattern="[0-9]{8}" maxlength="8">
              <input type="submit" class="btn btn-primary" value="Siguiente" id="siguiente">
          </form>
        </div>
      </section>

  <script>     
      function habilitarSiguiente() {
          const dniInput = document.getElementById("dni_recuperar");
          const siguienteButton = document.getElementById("siguiente");

          if (dniInput.value.match(/^[0-9]{8}$/)) {
              siguienteButton.classList.remove("disabled");
              siguienteButton.removeAttribute("disabled");
          } else {
              siguienteButton.classList.add("disabled");
              siguienteButton.setAttribute("disabled", "true");
          }
      }  
      document.getElementById("dni_recuperar").addEventListener("input", habilitarSiguiente);   
      habilitarSiguiente();
  </script>

  </body>
</html>