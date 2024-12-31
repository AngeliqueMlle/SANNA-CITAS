<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        include_once "../config/bd.php";
        $conexionBD = BD::crearInstancia();

        $dni = $_SESSION["dni_usuario"];
        $token_ingresado = $_POST["token"];

        // Supongamos que ya tienes el DNI del usuario en la variable $dni
        $queryObtenerToken = "SELECT token_recuperacion FROM usuario WHERE persona_id_persona = (SELECT id_persona FROM persona WHERE dni = ?)";
        $stmtObtenerToken = $conexionBD->prepare($queryObtenerToken);
        $stmtObtenerToken->bindParam(1, $dni, PDO::PARAM_STR);
        $stmtObtenerToken->execute();
        $result = $stmtObtenerToken->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $token_almacenado = $result["token_recuperacion"];

            // Compara el token ingresado por el usuario con el token almacenado en la base de datos
            if ($token_ingresado === $token_almacenado) {
                // Token correcto, redirige al usuario a la página de cambio de contraseña
                header("Location: ../cambiar_contrasena.php");
                exit();
            } else {
                // El token no coincide, muestra un mensaje de error

                $_SESSION["intentos"] = isset($_SESSION["intentos"]) ? $_SESSION["intentos"] + 1 : 1;
                
                // Verifica si se superó el límite de intentos (3 intentos en este caso)
                if ($_SESSION["intentos"] >= 3) {
                    unset($_SESSION["intentos"]); // Limpia la variable de sesión
                    header("Location: ../dni.php"); // Redirige al formulario de DNI
                    exit();
                } else {
                    // Muestra un mensaje de error y permite al usuario intentarlo nuevamente
                    echo '
                        <script>
                        alert("Token incorrecto, intento número ' . $_SESSION["intentos"] . '")
                        window.location="../token.php"; // Ajusta la ruta correcta
                        </script>
                    ';
                    exit();
                }
            }
        } else {
            echo '
                <script>
                alert("Error al obtener token de base de datos")
                window.location="../token.php";
                </script>
            ';
            exit();
        }
    } catch (Exception $e) {
        // Manejo de excepciones
        echo "Error en la base de datos: " . $e->getMessage();
    }
}
?>
