<?php
require_once 'clases/conexion/conexion.php';
require_once 'clases/respuestas.class.php';
require_once 'clases/envio_mail.class.php';

class EliminarTurno extends conexion{
    private $query = "";
    public function eliminarTurno($TurnoId){
        $this->query = "DELETE FROM  " . "turnos" . " WHERE TurnoId = " . $TurnoId;
        $res = parent::nonQuery($this->query);
        if($res) return "el turno cancelado con éxito";
        else return "Este turno ya ha sido cancelado";
    }
}
