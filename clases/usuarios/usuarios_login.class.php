<?php
require_once 'clases/conexion/conexion.php';
require_once 'clases/respuestas.class.php';

class usuarios_login extends conexion{

    private $TokenLogin = '912b302f04aec8464474320c5cd06759';

    public function login($json){
        $_respustas = new respuestas;
        $datos = json_decode($json,true);
        if(!isset($datos['token']) || !isset($datos['email']) || !isset($datos["password"])){
            //error con los campos
            return $_respustas->error_400('Todos los campos son requeridos');
        }else{
            //todo esta bien 
            $usuario = $datos['email'];
            $password = $datos['password'];
            $password = parent::encriptar($password);

            if (!isset($datos['token'])) {
                //return json_encode($datos['token']);
                return $_respustas->error_401('No tiene el token');
            } else if ($datos['token'] != $this->TokenLogin) {
                return $_respustas->error_401('No tiene autorizacion con el token');
            }

            $datos = $this->obtenerDatosUsuario($usuario);
            if($datos){
                //verificar si la contraseña es igual
                    if($password == $datos[0]['Password']){
                            if($datos[0]['Estado'] == "ACTIVO"){
                                //crear el token
                                $verificar  = parent::insertarToken($datos[0]['UsuarioId']);
                                if($verificar){
                                        // si se guardo
                                        $result = $_respustas->response;
                                        $result["result"] = array(
                                            "token" => $verificar,
                                            "UsuarioId" => $datos[0]['UsuarioId'],
                                            "Usuario" => $datos[0]['Usuario'],
                                            "Nombre" => $datos[0]['nombre'],
                                            "foto_selfie" => $datos[0]['selfie'],
                                            "RoleId" => $datos[0]['RoleId'],
                                            "estado" => $datos[0]['Estado']
                                        );
                                        return $result;
                                }else{
                                        //error al guardar
                                        return $_respustas->error_500("Error interno, No hemos podido guardar");
                                }
                            }else{
                                //el usuario esta inactivo
                                return $_respustas->error_200("El usuario esta inactivo");
                            }
                    }else{
                        //la contraseña no es igual
                        return $_respustas->error_200("El password es invalido");
                    }
            }else{
                //no existe el usuario
                return $_respustas->error_200("El usuaro $usuario  no existe ");
            }
        }
    }

    private function obtenerDatosUsuario($correo){
        $query = "SELECT UsuarioId,Password,Estado, nombre, Usuario, selfie, RoleId, telefono FROM usuarios WHERE Usuario = '$correo'";
        $datos = parent::obtenerDatos($query);
        if(isset($datos[0]["UsuarioId"])){
            return $datos;
        }else{
            return 0;
        }
    }
}


?>