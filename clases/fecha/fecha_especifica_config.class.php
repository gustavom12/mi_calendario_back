<?php
require_once 'clases/conexion/conexion.php';
require_once 'clases/respuestas.class.php';
require_once 'clases/envio_mail.class.php';

class categorias_registrar extends conexion
{
    private $table = 'configuracion_especifica';
    private $query = '';

    private $fecha = "";
    private $id = 0;
    private $desde = '';
    private $hasta = '';
    private $desde_1 = '';
    private $hasta_1 = '';

    private $queryConfiguracion = '';
    public function registrar($json)
    {
        $_respuestas = new respuestas;
        $datos = json_decode($json, true);
        $this->fecha = $datos["fecha"];
        $this->desde = $datos["desde"];
        $this->hasta = $datos["hasta"];
        $this->desde_1 = $datos["desde_1"];
        $this->hasta_1 = $datos["hasta_1"];
        // si existe esta fecha, la elimino para insertar una nueva 
        $this->query = "DELETE FROM " . $this->table . " WHERE " . "fecha = " . '"' . $this->fecha . '"';
        parent::nonQuery($this->query);
        $this->queryConfiguracion = "INSERT INTO " . $this->table . "(fecha, desde, hasta, desde_1, hasta_1) values (" . "'" . $this->fecha . "','" . $this->desde . "','" . $this->hasta . "','" . $this->desde_1 . "','"  . $this->hasta_1 . "');";
        $resp = parent::nonQueryId($this->queryConfiguracion);
        $result = '';
        $result = $_respuestas->response;
        if ($resp) {
            $result["result"] = array(
                "mensaje" => "Se registro la categoria con éxito"
            );
        } else {
            $result["result"] = array(
                "mensaje" => "No se registro la categoria"
            );
        }
        return $result;
    }
}
