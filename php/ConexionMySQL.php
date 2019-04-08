<?php
/**
 * Clase que define una conexión a la BD de MySQL.
 * 
 * @author Stiven Muñoz Murillo
 * @version 06/04/2019
 */
class ConexionMySQL
{
    private $conexion;

    public function __construct()
    {
        $user = "root";
        $pass = "";
        $server = "localhost";
        $nombrebd = "root";

        // Crea la conexión con el motor de BD MySQL.
        $this->conexion = mysqli_connect($server, $user, $pass, $nombrebd);
    }

    public function getConexion()
    {
        return $this->conexion;
    }

    /**
     * Se ejecuta de forma automatica al terminar de usar un objeto de esta clase.
     */
    public function __destruct()
    {
        mysqli_close($this->conexion);
    }
}
