<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        include_once "../config/bd.php";
        $conexionBD = BD::crearInstancia();

        $dni = $_SESSION["dni_usuario"]; // Accede al DNI desde la variable de sesión
        $nueva_contrasena = $_POST["nueva_contrasena"];
        $confirmar_contrasena = $_POST["confirmar_contrasena"];
        $salt = generarSalt();

                // Token correcto, verifica que la nueva contraseña y la confirmación coincidan
                if ($nueva_contrasena === $confirmar_contrasena) {
                    // Las contraseñas coinciden, actualiza la contraseña
                    $hash_contrasena = password_hash($nueva_contrasena . $salt, PASSWORD_DEFAULT); // Hashea la nueva contraseña

                    $queryActualizarContrasena = "UPDATE usuario SET hash_contrasena = ?, salt = ? WHERE persona_id_persona = (SELECT id_persona FROM persona WHERE dni = ?)";
                    $stmtActualizarContrasena = $conexionBD->prepare($queryActualizarContrasena);
                    $stmtActualizarContrasena->bindParam(1, $hash_contrasena, PDO::PARAM_STR);
                    $stmtActualizarContrasena->bindParam(2, $salt, PDO::PARAM_STR);
                    $stmtActualizarContrasena->bindParam(3, $dni, PDO::PARAM_STR);
                    
                    if ($stmtActualizarContrasena->execute()) {
                        // Contraseña actualizada con éxito
                        echo '
                            <script>
                                alert("Contraseña actualizada con éxito")
                                window.location="../iniciarsesion.php"; // Redirige al inicio de sesión
                            </script>
                        ';
                        exit();
                    } else {
                        // Error al actualizar la contraseña
                        echo '
                            <script>
                                alert("Error al actualizar la contraseña")
                                window.location="../cambiar_contrasena.php"; // Redirige a la página de cambio de contraseña
                            </script>
                        ';
                        exit();
                    }
                } else {
                    // Las contraseñas no coinciden, muestra un mensaje de error
                    echo '
                        <script>
                            alert("Las contraseñas no coinciden")
                            window.location="../cambiar_contrasena.php"; // Redirige a la página de cambio de contraseña
                        </script>
                    ';
                    exit();
                }
    } catch (Exception $e) {
        // Manejo de excepciones
        echo "Error en la base de datos: " . $e->getMessage();
    }
}

function generarSalt($length = 32) {
    // Utiliza una función segura para generar un salt aleatorio
    return bin2hex(random_bytes($length));
}

?>
