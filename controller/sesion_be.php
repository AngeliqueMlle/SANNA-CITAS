<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        include_once '../config/bd.php';
        $conexionBD = BD::crearInstancia();

        $dni = $_POST['username'];
        $contrasena = $_POST['password'];
        $captcha = $_POST['g-recaptcha-response'];

        $resultado = obtenerUsuarioPorDNI($dni, $conexionBD);
        $idUsuario = $resultado['idUsuario'];

        if ($resultado){
            // Verifica la contraseña ingresada con el hash almacenado en la base de datos
            if (password_verify($contrasena . $resultado['saltUsuario'], $resultado['contrasenaUsuario'])) {
                
                if (isValidRecaptcha($captcha)) {
                    crearSesion($idUsuario, $conexionBD);
                    header("Location: ../cita.php");
                    exit();
                } else {
                    echo '
                        <script>
                        alert("Error: Por favor, completa el reCAPTCHA ")
                        window.location="../iniciarsesion.php";
                        </script>
                    ';
                }
            } else {
                echo '
                    <script>
                    alert("Contraseña incorrecta. Intenta de nuevo.")
                    window.location="../iniciarsesion.php";
                    </script>
                ';
            }
        } else {
            echo '
                <script>
                alert("Usuario no encontrado. Regístrate antes de iniciar sesión.")
                window.location="../iniciarsesion.php";
                </script>
            ';
        }
    } catch (Exception $e) {
        echo 'Error en la base de datos: ' . $e->getMessage();
    }
}

function isValidRecaptcha($captcha) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $secretKey = '6LdE5GYoAAAAAIIlr2TLLfA_Mo86jNRi6IT0Ap41';              
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha&remoteip=$ip";
    $respuesta = file_get_contents($url);
    $responseData = json_decode($respuesta, true);
    return isset($responseData['success']) && $responseData['success'] === true;
}
function crearSesion($idUsuario, $conexionBD) {
    session_start();
    $_SESSION['idUsuario'] = $idUsuario;
    $ipSesion = $_SERVER['REMOTE_ADDR'];
    $fechaInicioSesion = date("Y-m-d H:i:s");

    $sql = "CALL CrearSesion(:idUsuario, :ipSesion, :fechaInicioSesion, null)";
    $stmt = $conexionBD->prepare($sql);
    $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
    $stmt->bindParam(':ipSesion', $ipSesion, PDO::PARAM_STR);
    $stmt->bindParam(':fechaInicioSesion', $fechaInicioSesion, PDO::PARAM_STR);
    $stmt->execute();
}
function obtenerUsuarioPorDNI($dni, $conexionBD) {
    $sql = "CALL ObtenerUsuarioPorDNI(:dni)";
    $stmt = $conexionBD->prepare($sql);
    $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        return null;
    }
}
?>
