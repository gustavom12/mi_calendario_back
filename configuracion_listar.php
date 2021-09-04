<?php
require_once 'clases/respuestas.class.php';
require_once 'clases/configuracion/configuracion_listar.class.php';
require_once 'clases/conexion/cors.php';

$_respuestas = new respuestas;
$_usuarios = new configuracion_listar;
$listaUsuarios = '';

if($_SERVER['REQUEST_METHOD'] == "GET"){
    $listaUsuarios = $_usuarios->listarConfiguracion();
    header("Content-Type: application/json");
    echo json_encode($listaUsuarios);
    http_response_code(200);
}

?>