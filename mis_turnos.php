<?php
require_once 'clases/respuestas.class.php';
require_once 'clases/turnos/mis_turnos.class.php';
require_once 'clases/conexion/cors.php';

$_respuestas = new respuestas;
$mis_turnos = new MisTurnos;
$turnos;

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $UsuarioId = $_GET['UsuarioId'];
    $turno = $mis_turnos->obtenerMisTurnos($UsuarioId);
    header("Content-Type: application/json");
    echo json_encode($turno);
    http_response_code(200);
}