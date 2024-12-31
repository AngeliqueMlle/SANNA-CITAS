<?php
require_once "controller/sesion_be.php";
require_once 'config/bd.php';
use PHPUnit\Framework\TestCase;

class IniciarSesionTest extends TestCase {

    public function testExisteUsuario (){
        $expected = false;
        $actual = obtenerUsuarioPorDNI("22222222", BD::crearInstancia());
        $this->assertEquals($expected, $actual);
    }

}

?>