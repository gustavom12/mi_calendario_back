<?php
require_once 'clases/conexion/conexion.php';
require_once 'clases/respuestas.class.php';

class configuracion_listar extends conexion{

    private $query = '';

    public function listarConfiguracion(){
        $this->query = 'SELECT dia, nombre, desde, hasta, desde_1, hasta_1, intervalo FROM configuracion_turnos order by dia';
        $datos = parent::obtenerDatos($this->query);
        return ($datos);
    }
}


?>