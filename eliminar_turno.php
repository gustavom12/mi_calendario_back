<?php
require_once 'clases/respuestas.class.php';
require_once 'clases/turnos/eliminar_turno.class.php';
require_once 'clases/conexion/cors.php';

$_respuestas = new respuestas;
$mis_turnos = new EliminarTurno("");
$turnos;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $TurnoId = $_GET['TurnoId'];
    $turno = $mis_turnos->eliminarTurno($TurnoId);
    header("Content-Type: application/json");
    echo json_encode($turno);
    http_response_code(200);
}