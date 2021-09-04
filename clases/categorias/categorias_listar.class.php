<?php
require_once 'clases/conexion/conexion.php';
require_once 'clases/respuestas.class.php';

class categorias_listar extends conexion{

    private $query = '';

    public function listarCategorias(){
        $this->query = 'SELECT CategoriaId, NegocioId, nombre, duracion_minutos, estado, costo FROM configuracion_categorias order by CategoriaId';
        $datos = parent::obtenerDatos($this->query);
        return ($datos);
    }
}
?>