<?php
require_once 'clases/conexion/conexion.php';
require_once 'clases/respuestas.class.php';
require_once 'clases/envio_mail.class.php';

//En esta clase se devuelven toda la info de una fecha especifica, es decir:
//se da info de todos los turnos dados, la configuración especifica del dia (si es que tiene)
//y en caso de que no tenga config especifica, se devuelve la configuración general del dia

class fecha_turnos_y_config extends conexion
{
    private $tablaFechaEspecifica = "configuracion_especifica";
    private $tabla_config_general = "configuracion_turnos";
    private $config_query = "";
    private $turnos_config;
    private $turnos;
    public function fecha_turnos_config($fecha, $dia)
    {
        //Obtiene los turnos de esta fecha
        $this->turnos_query = "SELECT * FROM " . "turnos" . " WHERE fecha = " . $fecha . "ORDER BY hora ASC";
        $this->turnos = parent::obtenerDatos($this->turnos_query);
        //Obtiene la configuracion del dia (desde, hasta...)
        //Busca si esta fecha tiene una configuración específica
        $this->config_query = "SELECT * FROM " . $this->tablaFechaEspecifica . " WHERE fecha = " . $fecha;
        $this->turnos_config = parent::obtenerDatos($this->config_query);
        if (!$this->turnos_config) {
            $this->config_query = "SELECT * FROM " . $this->tabla_config_general . " WHERE dia = " . $dia; 
        }
        $this->turnos_config = parent::obtenerDatos($this->config_query);
        return [
            "turnos" => $this->turnos,
            "config" => $this->turnos_config
        ];
    }
}