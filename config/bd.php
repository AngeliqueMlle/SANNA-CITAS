<?php 

class BD{

    public static $instancia=null;

    public static $host = "localhost";
    public static $nombreBD = "dbclinica";
    public static $usuario = "root";
    public static $contrasena = "";


    public static function crearInstancia(){
       
        if(!isset(self::$instancia)){

            $opciones[PDO::ATTR_ERRMODE]= PDO::ERRMODE_EXCEPTION;

            $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$nombreBD;
            
            self::$instancia = new PDO($dsn, self::$usuario, self::$contrasena, $opciones);            
        }
        return self::$instancia;
    }
}

?>