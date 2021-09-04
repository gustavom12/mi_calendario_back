<?php
require_once 'clases/respuestas.class.php';
require_once 'clases/conexion/cors.php';
require_once "clases/categorias/categorias_registrar.class.php";
$_respuestas = new respuestas;
$_usuarios = new categorias_registrar;
$listaUsuarios = '';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    //recibir datos
    $postBody = file_get_contents("php://input");
    //enviamos los datos al manejador
    $datosArray = $_usuarios->registrar($postBody);

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
