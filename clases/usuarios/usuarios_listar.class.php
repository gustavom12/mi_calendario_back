<?php
require_once 'clases/conexion/conexion.php';
require_once 'clases/respuestas.class.php';

class usuarios_listar extends conexion{

    public function listarUsuarios($sort, $search, $page, $id){
        $inicio  = 0 ;
        $cantidad = 10;
        if($page > 1){
            $inicio = ($cantidad * ($page - 1)) +1 ;
            $cantidad = $cantidad * $page;
        }

        $condicion = '';
        $orderBy = '';
        $limit = '';

        if ($page){
            $limit = ' LIMIT ' . $inicio . ',' . $cantidad;
        }

        if($id){
            $condicion = "WHERE U.UsuarioId = $id ";
        }else{
            if($search){
                $condicion = "WHERE (U.nombre like '%$search%' OR U.usuario like '%$search%')";
            }
        }

        if($sort){
            $orderBy = ' ORDER BY 1 ' . $sort;
        }

        $this->query = 'SELECT `UsuarioId`,`Usuario`,`Estado`,`nombre`,`telefono`,U.`RoleId`,`selfie`, r.`descripcion` as role FROM usuarios AS U inner join roles as r on U.RoleId = r.RoleId ' . $condicion . $orderBy . $limit;

        $datos = parent::obtenerDatos($this->query);
        return ($datos);
    }
    
}


?>