<?php
require_once 'clases/conexion/conexion.php';
require_once 'clases/respuestas.class.php';
require_once 'clases/envio_mail.class.php';

class Crear_turno extends conexion
{
    private $table = 'turnos';
    private $query = '';
    private $NegocioId = "";
    private $dia = "";
    private $email = "";
    private $fecha = "";
    private $telefono = "";
    private $hora = "";
    private $nombre_usuario = "";
    private $nombre_negocio = "";
    private $duracion_minutos = "";

    public function crear_turno($json)
    {
        $_respuestas = new respuestas;
        $datos = json_decode($json, true);
        $this->NegocioId = $datos["NegocioId"];
        $this->telefono = $datos["telefono"] ?? null;
        $this->dia = $datos["dia"];
        $this->fecha = $datos["fecha"];
        $this->email = $datos["email"];
        $this->hora = preg_replace("/\s+/", '', $datos["hora"]);
        $this->precio = $datos["precio"];
        $this->categoria = $datos["categoria"];
        $this->nombre_usuario = $datos["nombre_usuario"];
        $this->nombre_negocio = $datos["nombre_negocio"];
        $this->duracion_minutos = $datos["duracion_minutos"];
        $result = '';
        $result = $_respuestas->response;
        $campos = " (email, NegocioId, telefono, dia, fecha, hora, nombre_usuario, nombre_negocio, duracion_minutos, precio, categoria)";
        $values = "'" . $this->email ."','" . $this->NegocioId . "','" . $this->telefono . "','" . $this->dia . "','" . $this->fecha . "','" . $this->hora . "','" . $this->nombre_usuario . "','" . $this->nombre_negocio . "','" . $this->duracion_minutos . "','" . $this->precio . "','" . $this->categoria .  "');";
        $this->query = "INSERT INTO " . $this->table . $campos . " values ( " . $values;
        $resp = parent::nonQueryId($this->query);
        if ($resp) {    
            $result["result"] = array(
                "mensaje" => "Se registro el turno con éxito"
            );
        } else {
            $result["result"] = array(
                "mensaje" => "No se pudo registrar el turno, vuelve a intentarlo"
            );
        }
        return $result;
    }
}