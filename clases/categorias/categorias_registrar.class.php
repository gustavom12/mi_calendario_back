<?php
require_once 'clases/conexion/conexion.php';
require_once 'clases/respuestas.class.php';
require_once 'clases/envio_mail.class.php';

class categorias_registrar extends conexion
{
    private $table = 'configuracion_categorias';
    private $query = '';

    private $NegocioId = "1";
    private $categoriaId = "";
    private $nombre = "";
    private $tiempo = "";
    private $estado = "activo";
    private $costo = "";

    private $queryConfiguracion = '';
    public function registrar($json)
    {
        $_respuestas = new respuestas;
        $datos = json_decode($json, true);
        $this->nombre = $datos["nombre"];
        $this->tiempo = $datos["duracion_minutos"];
        $this->costo = $datos["costo"];
        $this->CategoriaId = $datos["CategoriaId"];
        //Si existe la "CategoriaId", elimino esta tabla y vuelvo a insertar una nueva con los nuevos datos
        if ($this->CategoriaId) {
            $this->query = "DELETE FROM " . $this->table . " WHERE " . "CategoriaId = " . $this->CategoriaId;
            parent::nonQuery($this->query);
        }
        $this->queryConfiguracion = "INSERT INTO " . $this->table . " (NegocioId,nombre,duracion_minutos,estado,costo) values (" . $this->NegocioId . ",'" . $this->nombre . "','" . $this->tiempo . "','" . $this->estado . "','" . $this->costo . "'" . ");";
        $res =  $this->insertarConfiguracion();
        $result = '';
        // si se guardo
        $result = $_respuestas->response;
        if ($res) {
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

    private function insertarConfiguracion()
    {
        $resp = parent::nonQueryId($this->queryConfiguracion);
        if ($resp) {
            return $resp;
        } else {
            return 0;
        }
    }
}
