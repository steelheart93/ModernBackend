<?php
/**
 * Clase que define una conexión a la BD de Oracle.
 * 
 * @author Stiven Muñoz Murillo
 * @version 06/04/2019
 */
class ConexionOracle
{
    private $conexion;

    public function __construct()
    {
        $user = "root";
        $pass = "root";
        $server = "localhost/xe";

        // Crea la conexión con el motor de BD Oracle.
        $this->conexion = oci_connect($user, $pass, $server);
    }

    public function getConexion()
    {
        return $this->conexion;
    }

    public function __destruct()
    {
        oci_close($this->conexion);
    }
}
