<?php
require_once 'clases/conexion/conexion.php';
require_once 'clases/respuestas.class.php';

class usuarios_borrar extends conexion
{
    private $refLink = '';
    private $table = 'usuarios';
    private $UsuarioId = '';
    private $nombre = '';
    private $apellido = '';
    private $usuario = '';
    private $password = '';
    private $documento = '';
    private $telefono = '';
    private $direccion = '';
    private $localidad = '';
    private $provincia = '';
    private $codigo_postal = '';
    private $hash_billetera = '';
    private $inversion_total = 0;
    private $ganancia_total = 0;
    private $RoleId = 0;
    private $foto_dni1 = '';
    private $foto_dni2 = '';
    private $selfie = '';
    private $link_referido = '';
    private $estado = '';
    private $TokenPrimerRegistro = '912b302f04aec8464474320c5cd06759';
    private $token = '';
    private $query = '';
    //Email encriptado para luego validar el mismo
    private $hash_validacion = '';

    public function borrar($json)
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

                    $resp = $this->borrarUsuario();
                    if ($resp) {
                        $this->borrarToken();
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

    private function borrarUsuario()
    {
        $this->query = "DELETE FROM " . $this->table . " WHERE UsuarioId = " . $this->UsuarioId;

        $resp = parent::nonQuery($this->query);
        if ($resp >= 1) {
            return $resp;
        } else {
            return 0;
        }
    }

    private function borrarToken()
    {
        $this->query = "DELETE FROM " . $this->table ."_token WHERE UsuarioId = " . $this->UsuarioId;

        $resp = parent::nonQuery($this->query);
        if ($resp >= 1) {
            return $resp;
        } else {
            return 0;
        }
    }
}