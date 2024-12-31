<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        include_once "../config/bd.php";
        $conexionBD = BD::crearInstancia();

        $dni = $_POST["dni"];

        // Preparar la consulta SQL para verificar si el DNI ya existe
        $queryVerificarDNI = "SELECT COUNT(*) AS count FROM persona WHERE dni = ?";
        $stmtVerificarDNI = $conexionBD->prepare($queryVerificarDNI);
        $stmtVerificarDNI->bindParam(1, $dni, PDO::PARAM_STR);
        $stmtVerificarDNI->execute();
        $result = $stmtVerificarDNI->fetch(PDO::FETCH_ASSOC);

        if ($result["count"] > 0) {
            // El DNI existe en la base de datos, redirige al usuario a la pantalla deseada
            $_SESSION["dni_valido"] = true;
            $_SESSION["dni_usuario"] = $dni;
            $_SESSION["correo_electronico"] = obtenerCorreoElectronico($conexionBD, $dni); // Función para obtener el correo

            $token = sprintf("%04d", rand(0, 9999)); // Genera un token de 4 dígitos

            // Actualiza el campo token_recuperacion en la tabla usuario con el nuevo token
            actualizarToken($conexionBD, $dni, $token);

            // Redirige al usuario a la página donde debe ingresar el token
            header("Location: ../token.php");
            exit();
        } else {
            // El DNI no existe, muestra un mensaje de error o redirige a otra pantalla de error
            $_SESSION["dni_valido"] = false;
            header("Location: ../dni.php");
            exit();
        }
    } catch (Exception $e) {
        // Manejo de excepciones,
        echo "Error en la base de datos: " . $e->getMessage();
    }
}

function obtenerCorreoElectronico($conexion, $dni) {
    $queryObtenerCorreo = "SELECT correo_electronico FROM persona WHERE dni = ?";
    $stmtObtenerCorreo = $conexion->prepare($queryObtenerCorreo);
    $stmtObtenerCorreo->bindParam(1, $dni, PDO::PARAM_STR);
    $stmtObtenerCorreo->execute();
    $resultCorreo = $stmtObtenerCorreo->fetch(PDO::FETCH_ASSOC);

    return $resultCorreo ? $resultCorreo["correo_electronico"] : null;
}

function actualizarToken($conexion, $dni, $token) {
    $queryActualizarToken = "UPDATE usuario SET token_recuperacion = ? WHERE persona_id_persona = (SELECT id_persona FROM persona WHERE dni = ?)";
    $stmtActualizarToken = $conexion->prepare($queryActualizarToken);
    $stmtActualizarToken->bindParam(1, $token, PDO::PARAM_STR);
    $stmtActualizarToken->bindParam(2, $dni, PDO::PARAM_STR);
    $stmtActualizarToken->execute();
}
?>
