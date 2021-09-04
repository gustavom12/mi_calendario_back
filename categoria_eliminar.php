<?php
require_once 'clases/respuestas.class.php';
require_once 'clases/conexion/cors.php';
require_once "clases/categorias/categoria_eliminar.class.php";
$_respuestas = new respuestas;
$_usuarios = new CategoriaEliminar;
$listaUsuarios = '';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    //recibir datos
    $id = $_GET["id"];
    //delvolvemos una respuesta
    $datosArray = $_usuarios->eliminar_categoria($id);
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