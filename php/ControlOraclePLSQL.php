<?php
/**
 * Clase controladora de la conexión y las consultas al motor de BD Oracle y funciones PLSQL.
 * 
 * @author Stiven Muñoz Murillo
 * @version 06/04/2019
 */
include "ConexionOracle.php";
$conexion = new ConexionOracle();
$conexionbd = $conexion->getConexion();

// Imprimir la Excepción de la Conexión
if (!$conexionbd) {
    $m = oci_error();
    echo 'Error en la conexión con Oracle: ' . $m['message'];
}

// Si la consulta fetch esta bien realizada
if ($_SERVER["REQUEST_METHOD"] === "POST" && $_SERVER["CONTENT_TYPE"] === "application/json") {
    // Obtener los Datos POST sin tratar, (Receive the RAW post data).
    $content = trim(file_get_contents("php://input"));

    // Parsing Content en un JSON Object
    $json = json_decode($content);

    // Si existe un valor para el ranking en la consulta del cliente
    if (isset($json->ranking)) {
        $ranking = $json->ranking;
        $query = "SELECT CONSULTAR_RANKING($ranking) AS CADENA_JSON FROM DUAL";

        // Generar Consulta
        $statement = oci_parse($conexionbd, $query);
        // Imprimir la Excepción al Generar Consulta
        if (!$statement) {
            $m = oci_error($conexionbd);
            echo 'Error al generar la consulta: ' . $m['message'];
        }

        // Definir un nombre de variable para los atributos de la consulta
        oci_define_by_name($statement, 'CADENA_JSON', $cadena_json);

        // Ejecutar Consulta
        $run = oci_execute($statement);
        // Imprimir la Excepción al Ejecutar Consulta
        if (!$run) {
            $m = oci_error($statement);
            echo 'Error al ejecutar la consulta: ' . $m['message'];
        }

        // Recorrer todos los registros obtenidos por la consulta
        while (oci_fetch($statement)) {
            // Imprimir los registro para que los pueda visualisar el cliente
            echo $cadena_json;
        }

        // Eliminar Consulta
        oci_free_statement($statement);
    }
}
