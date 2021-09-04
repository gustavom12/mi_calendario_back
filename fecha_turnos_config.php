<?php
require_once 'clases/respuestas.class.php';
require_once 'clases/fecha/fechaTurnosYconfig.class.php';
require_once 'clases/conexion/cors.php';

$_respuestas = new respuestas;
$_usuarios = new fecha_turnos_y_config;
$listaUsuarios = '';

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $fecha = $_GET['fecha'];
    $dia = $_GET["dia"];
    $listaUsuarios = $_usuarios->fecha_turnos_config($fecha, $dia);
    header("Content-Type: application/json");
    echo json_encode($listaUsuarios);
    http_response_code(200);
}
