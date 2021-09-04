<?php
require_once 'clases/conexion/conexion.php';
require_once 'clases/respuestas.class.php';

class usuarios_clave extends conexion
{
    private $refLink = '';
    private $table = 'usuarios';
    private $UsuarioId = '';
    private $usuario = '';
    private $password = '';
    private $password_anterior = '';
    private $token = '';
    private $query = '';
    //Email encriptado para luego validar el mismo
    private $hash_validacion = '';

    private function validar_campos(){
        //validamos si todos los campos estan completos
        if ($this->UsuarioId == '' || $this->password == '' || $this->password_anterior == '')  
        {
            return 0;
        }
        else{
            return 1;
        }
    }

    public function cambiar($json)
    {
        $_respuestas = new respuestas;
        $datos = json_decode($json, true);

        if (!isset($datos['token'])) {
            return $_respuestas->error_401();
        } else {
            $this->token = $datos['token'];
            $arrayToken =   $this->buscarToken($this->token);
            if ($arrayToken) {
                if (!isset($datos['UsuarioId'])) {
                    return $_respuestas->error_400('Falta el UsuarioId para modificar');
                } else {
                    $this->UsuarioId = $datos['UsuarioId'];

                    //No modifico el usuario y password
                    if (isset($datos['password'])) {
                        $this->password = $datos['password'];
                    }
                    if (isset($datos['password_anterior'])) {
                        $this->password_anterior = $datos['password_anterior'];
                    }

                    if (!$this->validar_campos()){
                        return $_respuestas->error_400('Todos los campos son Requeridos');
                    }
                   
                    $this->password_anterior = parent::encriptar($this->password_anterior);
                    $this->password = parent::encriptar($this->password);

                    $datos = $this->obtenerDatosUsuario();
                    if($datos){
                    //verificar si la contraseña es igual
                        if(!$this->password_anterior == $datos[0]['Password']){
                            return $_respuestas->error_400('No coincide la contraseña');
                        }
                    }

                    $resp = $this->modificarUsuario();
                    if ($resp) {
                        $respuesta = $_respuestas->response;
                        $respuesta["result"] = array(
                            "UsuarioId" => $this->UsuarioId
                        );
                        return $respuesta;
                    } else {
                        return $_respuestas->error_500($this->query);
                    }
                }
            } else {
                return $_respuestas->error_401("El Token que envio es invalido o ha caducado");
            }
        }
    }

    private function modificarUsuario()
    {
        $this->query = "UPDATE " . $this->table . " SET password = '" . $this->password . "' WHERE UsuarioId = " . $this->UsuarioId;

        $resp = parent::nonQuery($this->query);
        if ($resp >= 1) {
            return $resp;
        } else {
            return 0;
        }
    }

    private function obtenerDatosUsuario(){
        $query = "SELECT UsuarioId,Password,Estado, nombre, apellido, Usuario FROM usuarios WHERE UsuarioId = " . $this->UsuarioId;
        $datos = parent::obtenerDatos($query);
        if(isset($datos[0]["UsuarioId"])){
            return $datos;
        }else{
            return 0;
        }
    }
}
