<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {    
    try {
        include_once '../config/bd.php';
        $conexionBD = BD::crearInstancia();

        // Recopilar datos del formulario
        $nombres = strtoupper($_POST["nombresUsuario"]);
        $apellidos = strtoupper($_POST["apellidosUsuario"]);
        $fechaNacimiento = $_POST["fechaNacimiento"];
        $fechaNacimientoForm = date("Y-m-d", strtotime($fechaNacimiento));
        $celular = $_POST["celularUsuario"];
        $correo = $_POST["correoUsuario"];
        $dni = ($_POST["dniUsuario"]);
        $contrasena = $_POST['contrasenaUsuario'];
        $contrasenaConf = $_POST['contrasenaConfUsuario'];
        $salt = generarSalt();
            if (
                validarTexto($nombres, 45) && validarTexto($apellidos, 45) &&
                validarFecha($fechaNacimientoForm) && validarTelefono($celular) &&
                validarEmail($correo) && validarDNI($dni) &&
                validarContrasena($contrasena) && validarCoincidenciaContrasena($contrasena, $contrasenaConf)
            ) {
                   // Verificar duplicados
            if (verificarDuplicadoCorreo($correo, $conexionBD) || verificarDuplicadoDNI($dni, $conexionBD)) {
                echo '
                    <script>
                        alert("Hay campos registrados en nuestro sistema. Verifique el correo o DNI ingresado");
                        window.location="../registrate.php";
                    </script>
                ';
            } else {
                $contrasenaHash = password_hash($contrasena . $salt, PASSWORD_DEFAULT);

                $sql = "CALL CrearUsuario(:nombres, :apellidos, :fechaNacimientoForm, :celular, :correo, :dni, :contrasenahash, :salt, null)";
                $stmtUsuario = $conexionBD->prepare($sql);
                $stmtUsuario->bindParam(':nombres', $nombres, PDO::PARAM_STR);
                $stmtUsuario->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
                $stmtUsuario->bindParam(':fechaNacimientoForm', $fechaNacimientoForm, PDO::PARAM_STR);
                $stmtUsuario->bindParam(':celular', $celular, PDO::PARAM_STR);
                $stmtUsuario->bindParam(':correo', $correo, PDO::PARAM_STR);
                $stmtUsuario->bindParam(':dni', $dni, PDO::PARAM_STR);
                $stmtUsuario->bindParam(':contrasenahash', $contrasenaHash, PDO::PARAM_STR);
                $stmtUsuario->bindParam(':salt', $salt, PDO::PARAM_STR);
                if ($stmtUsuario->execute()) {
                    echo '
                        <script>
                            alert("Usuario creado exitosamente.");
                            window.location="../iniciarsesion.php?success=1";
                        </script>
                    ';
                } else {
                    echo "Error al ejecutar el procedimiento almacenado: " . $stmtUsuario->errorInfo()[2];
                }
            }
        } else {
            echo '
                <script>
                    alert("Por favor, verifique los datos ingresados.");
                    window.location="../registrate.php";
                </script>
            ';
        }
    } catch (Exception $e) {
        echo 'Error en la base de datos: ' . $e->getMessage();
    }
} 

function verificarDuplicadoCorreo($correo, $conexionBD) {
    $sql = "CALL LeerUsuarioPorCorreo(:correo)";
    $stmt = $conexionBD->prepare($sql);
    $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
    $stmt->execute();   
    // Verifica si se encontró algún registro con el correo
    return $stmt->rowCount() > 0;
}
function verificarDuplicadoDNI($dni, $conexionBD) {
    $sql = "CALL LeerUsuarioPorDNI(:dni)";
    $stmt = $conexionBD->prepare($sql);
    $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
    $stmt->execute();
    // Verifica si se encontró algún registro con el DNI
    return $stmt->rowCount() > 0;
}
function generarSalt($length = 32) {
    // Utiliza una función segura para generar un salt aleatorio
    return bin2hex(random_bytes($length));
}
function validarTexto($campo, $longitudMaxima) {
    $campo = trim($campo); 
    if (empty($campo) || strlen($campo) > $longitudMaxima) {
        return false;
    }
    if (!preg_match('/^[A-Za-zÁáÉéÍíÓóÚú ]+$/', $campo)) {
        return false;
    }
    return true;
}
function validarEmail($email) {
    $email = filter_var($email, FILTER_SANITIZE_EMAIL); // Limpia el formato del correo
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    return true;
}
function validarFecha($fecha) {
    if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
        $partes = explode('-', $fecha);
        if (checkdate((int)$partes[1], (int)$partes[2], (int)$partes[0])) {
            // Calcula la fecha de nacimiento a partir de la fecha proporcionada
            $fechaNacimiento = new DateTime($fecha);
            $hoy = new DateTime();
            $edad = $hoy->diff($fechaNacimiento)->y;
            // Verifica si la edad es mayor o igual a 18 años
            if ($edad >= 18) {
                return true;
            }
        }
    }
    return false;
}
function validarTelefono($telefono) {
    if (preg_match('/^9\d{8}$/', $telefono)) {
        return true;
    }
    return false;
}
function validarDNI($dni) {
    if (preg_match('/^\d{8}$/', $dni)) {
        return true;
    }
    return false;
}
function validarContrasena($contrasena) {
    if (strlen($contrasena) < 8) {
        return false;
    }
    if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d).{8,}$/', $contrasena)) { 
        return false;
    }
    return true;
}
function validarCoincidenciaContrasena($contrasena, $contrasenaConf) {
    return $contrasena === $contrasenaConf;
}
?>