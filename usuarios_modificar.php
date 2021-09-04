<?php
require_once 'clases/respuestas.class.php';
require_once 'clases/usuarios/usuarios_modificar.class.php';
require_once 'clases/conexion/cors.php';

$_respuestas = new respuestas;
$_usuarios = new usuarios_modificar;

    //Registramos el usuario
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //recibimos los datos enviados
        $postBody = file_get_contents("php://input");
        //enviamos datos al manejador
        $datosArray = $_usuarios->modificar($postBody);
        //delvovemos una respuesta 
        header('Content-Type: application/json');
        if(isset($datosArray["result"]["error_id"])){
            $responseCode = $datosArray["result"]["error_id"];
            http_response_code($responseCode);
        }else{
            http_response_code(200);
        }
        echo json_encode($datosArray);
    }
?>