<?php
require_once 'clases/respuestas.class.php';
require_once 'clases/usuarios/usuarios_registrar.class.php';
require_once 'clases/conexion/cors.php';

$_respuestas = new respuestas;
$_usuarios = new usuarios_registrar;
$listaUsuarios = '';

$email = '';
$hash = '';
$datosArray = 0;

if($_SERVER['REQUEST_METHOD'] == "GET"){

    if(isset($_GET["email"])){
        $email = $_GET["email"];
    }
    if(isset($_GET["hash"])){
        $hash = $_GET["hash"];
    }

    $datosArray = $_usuarios->verificar_email($email, $hash);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validacion de registro de usuario</title>
</head>
<body>
    <?php
        if($datosArray == 1){
            echo ('Usuario Registrado correctamente.');
        }else{
            echo ('No se pudo registrar el usuario.');
        }
    ?>


</body>
</html>
