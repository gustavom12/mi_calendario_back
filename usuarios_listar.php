<?php
require_once 'clases/respuestas.class.php';
require_once 'clases/usuarios/usuarios_listar.class.php';
require_once 'clases/conexion/cors.php';

$_respuestas = new respuestas;
$_usuarios = new usuarios_listar;
$listaUsuarios = '';

$sort = '';
$search = '';
$page = '';
$estado = '';
$id = '';

if($_SERVER['REQUEST_METHOD'] == "GET"){
    if(isset($_GET["sort"])){
        $sort = $_GET["sort"];
    }

    if(isset($_GET["search"])){
        $search = $_GET["search"];
    }

    if(isset($_GET["page"])){
        $page = $_GET["page"];
    }

    if(isset($_GET["id"])){
        $id = $_GET["id"];
    }

    $listaUsuarios = $_usuarios->listarUsuarios($sort, $search, $page, $id);
    header("Content-Type: application/json");
    echo json_encode($listaUsuarios);
    http_response_code(200);
}

?>