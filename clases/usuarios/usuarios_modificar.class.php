<?php
require_once 'clases/conexion/conexion.php';
require_once 'clases/respuestas.class.php';

class usuarios_modificar extends conexion
{
    private $table = 'usuarios';
    private $UsuarioId = '';
    private $nombre = '';
    private $usuario = '';
    private $password = '';
    private $telefono = '';
    private $RoleId = 0;
    private $estado = '';
    private $TokenPrimerRegistro = '912b302f04aec8464474320c5cd06759';
    private $token = '';
    private $query = '';

    private function validar_campos(){
        //validamos si todos los campos estan completos
        if ($this->nombre == '' || $this->telefono == '')  
        {
            return 0;
        }
        else{
            return 1;
        }
    }

    public function modificar($json)
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
                    if (isset($datos['nombre'])) {
                        $this->nombre = $datos['nombre'];
                    }
                    
                    if (isset($datos['telefono'])) {
                        $this->telefono = $datos['telefono'];
                    }
                    
                    if (isset($datos['RoleId'])) {
                        $this->RoleId = $datos['RoleId'];
                    }

                    if ($this->RoleId == 0) {
                        //Si no obtengo el role id, le asigno por defecto 2: Usuario
                        $this->RoleId = 2;
                    }

                    if (!$this->validar_campos()){
                        return $_respuestas->error_400('Todos los campos son Requeridos');
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
        $this->query = "UPDATE " . $this->table . " SET nombre = '" . $this->nombre . "', telefono = '" . $this->telefono . "', RoleId=" . $this->RoleId . " WHERE UsuarioId = " . $this->UsuarioId;

        $resp = parent::nonQuery($this->query);
        if ($resp >= 1) {
            return $resp;
        } else {
            return 0;
        }
    }
}
