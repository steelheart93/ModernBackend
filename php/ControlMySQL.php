<?php
/**
 * Clase controladora de la conexión y las consultas al motor de BD MySQL.
 * 
 * @author Stiven Muñoz Murillo
 * @version 06/04/2019
 */
include "ConexionMySQL.php";
$conexion = new ConexionMySQL();
$conexionbd = $conexion->getConexion();

// Imprimir la Excepción de la Conexión
if (!$conexionbd) {
    echo 'Error en la conexión con MySQL: ' . mysqli_connect_error();
}

// Si existe un valor para el ranking en la consulta del cliente
if (isset($_GET["ranking"])) {
    $ranking = $_GET["ranking"];
    $query = "SELECT TOP_ID, EDITOR_NAME FROM TOP_EDITORS WHERE TOP_ID = $ranking";

    // Generar y Ejecutar Consulta
    $statement = mysqli_query($conexionbd, $query);
    // Imprimir la Excepción al Generar y Ejecutar Consulta
    if (!$statement) {
        echo 'Error al generar y ejecutar la consulta: ' . mysqli_connect_error();
    }

    // Obtener el unico registro devuelto por la consulta
    $fila = mysqli_fetch_assoc($statement);

    // Imprimir los registro para que los pueda visualisar el cliente
    echo json_encode($fila);
}
