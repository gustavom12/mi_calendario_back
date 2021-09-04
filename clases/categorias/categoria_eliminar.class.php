<?php
require_once 'clases/conexion/conexion.php';
require_once 'clases/respuestas.class.php';

class CategoriaEliminar extends conexion{
    private $table = "configuracion_categorias"; 
    private $query = "";
    public function eliminar_categoria($id){
        $this->query = "DELETE FROM " . $this->table . " WHERE CategoriaId = " . $id;
        echo $this->query;
        $resp = parent::nonQueryId($this->query);
        if ($resp) {
            return $resp;
        } else {
            return 0;
        }
    }
}