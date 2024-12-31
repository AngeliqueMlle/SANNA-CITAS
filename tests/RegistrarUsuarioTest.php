<?php
require_once 'controller/registra_usuario_be.php';
require_once 'config/bd.php';
use PHPUnit\Framework\TestCase;

class RegistrarUsuarioTest extends TestCase {

    public function testIsValidPassword (){
        $expected = false;
        $actual = validarContrasena("12");
        $this->assertEquals($expected, $actual);
    }

    public function testIsValidTelefono (){
        $expected = false;
        $actual = validarTelefono("");
        $this->assertEquals($expected, $actual);
    }

    public function testIsText(){
        $expected = false;
        $actual = validarTexto("",45);
        $this->assertEquals($expected, $actual);
    }
    public function testIsEmail(){
        $expected = false;
        $actual = validarEmail("angelique@");
        $this->assertEquals($expected, $actual);
    }
    public function testIsValidDni(){
        $expected = false;
        $actual = validarDNI("999999999");
        $this->assertEquals($expected, $actual);
    }
    
    public function testIsValidFecha(){
        $expected = false;
        $actual = validarFecha("2015-12-15");
        $this->assertEquals($expected, $actual);
    }

    public function testIsDuplicado(){
        $expected = false;
        $actual = verificarDuplicadoCorreo("asdasd",BD::crearInstancia());
        $this->assertEquals($expected, $actual);
    }
}

?>