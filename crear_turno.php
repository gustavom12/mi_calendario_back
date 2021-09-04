<?php
require_once 'clases/respuestas.class.php';
require_once 'clases/turnos/crear_turno.class.php';
require_once 'clases/conexion/cors.php';

$_respuestas = new respuestas;
$_usuarios = new Crear_turno("");
$listaUsuarios = '';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    //recibir datos
    $postBody = file_get_contents("php://input");
    //enviamos los datos al manejador
    $datosArray = $_usuarios->crear_turno($postBody);
    //delvolvemos una respuesta
    header('Content-Type: application/json');
    if(isset($datosArray["result"]["error_id"])){
        $responseCode = $datosArray["result"]["error_id"];
        http_response_code($responseCode);
    }else{
        http_response_code(200);
    }
    echo json_encode($datosArray);
}else{
    header('Content-Type: application/json');
    $datosArray = $_respuestas->error_405();
    echo json_encode($datosArray);
}

?>