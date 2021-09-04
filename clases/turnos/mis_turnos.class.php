<?php
require_once 'clases/conexion/conexion.php';
require_once 'clases/respuestas.class.php';
require_once 'clases/envio_mail.class.php';

class MisTurnos extends conexion{
    private $query = "";
    public function obtenerMisTurnos($userId){
        $this->query = "SELECT * FROM " . "turnos" . " WHERE UsuarioId = " . $userId . "ORDER BY fecha DESC";
        return parent::obtenerDatos($this->query);
    }
}
