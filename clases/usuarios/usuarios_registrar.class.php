<?php
require_once 'clases/conexion/conexion.php';
require_once 'clases/respuestas.class.php';
require_once 'clases/envio_mail.class.php';

class usuarios_registrar extends conexion
{
    private $table = 'usuarios';
    private $UsuarioId = '';
    private $nombre = '';
    private $apellido = '';
    private $usuario = '';
    private $password = '';
    private $telefono = '';
    private $RoleId = 0;
    private $selfie = '';
    private $estado = '';
    private $TokenPrimerRegistro = '912b302f04aec8464474320c5cd06759';
    private $token = '';
    private $query = '';

    public function registrar($json)
    {
        $_respuestas = new respuestas;
        $datos = json_decode($json, true);

        if (!isset($datos['token'])) {
            //return json_encode($datos['token']);
            return $_respuestas->error_401('No tiene el token');
        } else if ($datos['token'] != $this->TokenPrimerRegistro) {
            return $_respuestas->error_401('No tiene autorizacion con el token');
        } else 
        {
            // datos obligatorios
            if (isset($datos['email'])) {
                $this->usuario = $datos['email'];
            }

            if (isset($datos['password'])) {
                $this->password = $datos['password'];
            }

            if (isset($datos['nombre'])) {
                $this->nombre = $datos['nombre'];
            }

            if (isset($datos['telefono'])) {
                $this->telefono = $datos['telefono'];
            }
            
            if (isset($datos['RoleId'])) {
                $this->RoleId = $datos['RoleId'];
            }

            /*if (isset($foto_selfie)) {
                if ($foto_selfie["name"] != '')
                    $this->foto_selfie = 'SI';
            }*/

            if ($this->RoleId == 0) {
                //Si no obtengo el role id, le asigno por defecto 2: Usuario
                $this->RoleId = 2;
            }

            if (!$this->validar_campos()){
                return $_respuestas->error_400('Todos los campos son Requeridos');
            }

            $this->usuario = $datos['email'];
            $this->password = $datos['password'];
            //Encriptamos el password
            $this->password = parent::encriptar($this->password);

            // Validamos si ya existe el mail
            if ($this->validar_existe_email($this->usuario) == 1) {
                return $_respuestas->error_400('Ya se encuentra registrado el E-Mail');
            }

            $resp = $this->insertarUsuario();

            if ($resp) {
                $result = '';
                $verificar  = parent::insertarToken($resp);
                if($verificar){
                        // si se guardo
                        $result = $_respuestas->response;
                        $result["result"] = array(
                            "token" => $verificar,
                            "UsuarioId" => $resp
                        );
                }else{
                        //error al guardar
                        return $_respuestas->error_500("Error interno, No hemos podido guardar");
                }

                //Envio el Email de confirmacion
                //$this->enviar_email_confirmacion($this->usuario);
                
                return $result;
            } else {
                return $_respuestas->error_500($this->query);
            }
            
        }
    }

    private function validar_campos(){
        //validamos si todos los campos estan completos
        if ($this->usuario == '' || $this->password == '' || $this->nombre == '')  
        {
            return 0;
        }
        else{
            return 1;
        }
    }

    // validamos si existe el mail que esta ingresando
    private function validar_existe_email($email)
    {
        $query = "SELECT  UsuarioId from usuarios WHERE Usuario = '" . $email . "'";
        $resp = parent::obtenerDatos($query);
        if ($resp) {
            return 1;
        } else {
            return 0;
        }
    }

    private function insertarUsuario()
    {
        $this->query = "INSERT INTO " . $this->table . " (usuario,password,nombre,telefono,RoleId,estado) values ('" . $this->usuario . "','" . $this->password . "','" . $this->nombre . "','" . $this->telefono . "'," . $this->RoleId . ",'ACTIVO')";
        
        $resp = parent::nonQueryId($this->query);
        if ($resp) {
            return $resp;
        } else {
            return 0;
        }
    }
}
