<?php

class conexion {

    private $server;
    private $user;
    private $password;
    private $database;
    private $port;
    private $conexion;

    function __construct(){
        $listadatos = $this->datosConexion();
        foreach ($listadatos as $key => $value) {
            $this->server = $value['server'];
            $this->user = $value['user'];
            $this->password = $value['password'];
            $this->database = $value['database'];
            $this->port = $value['port'];
        }
        $this->conexion = new mysqli($this->server,$this->user,$this->password,$this->database);
        if($this->conexion->connect_errno){
            echo "No se pudo conectar a la DB";
            die();
        }

    }

    private function datosConexion(){
        $direccion = dirname(__FILE__);
        $jsondata = file_get_contents($direccion . "/" . "config");
        return json_decode($jsondata, true);
    }

    private function convertirUTF8($array){
        array_walk_recursive($array,function(&$item,$key){
            if(!mb_detect_encoding($item,'utf-8',true)){
                $item = utf8_encode($item);
            }
        });
        return $array;
    }

    public function obtenerDatos($sqlstr){
        $results = $this->conexion->query($sqlstr);
        $resultArray = array();
        if(!$results)return $this->convertirUTF8($resultArray);
        foreach ($results as $key) {
            $resultArray[] = $key;
        }
        return $this->convertirUTF8($resultArray);
    }

    public function nonQuery($sqlstr){
        //aveces no se llamaba al constructor por lo que arreglé el problema llamando al constructor manualmente
        $listadatos = $this->datosConexion();
        foreach ($listadatos as $key => $value) {
            $this->server = $value['server'];
            $this->user = $value['user'];
            $this->password = $value['password'];
            $this->database = $value['database'];
            $this->port = $value['port'];
        }
        $this->conexion = new mysqli($this->server,$this->user,$this->password,$this->database);
        if($this->conexion->connect_errno){
            echo "No se pudo conectar a la DB";
            die();
        }
        $results = $this->conexion->query($sqlstr);
        return $this->conexion->affected_rows;
    }

    //INSERT 
    public function nonQueryId($sqlstr){
        //aveces no se llamaba al constructor por lo que arreglé el problema llamando al constructor manualmente
        $listadatos = $this->datosConexion();
        foreach ($listadatos as $key => $value) {
            $this->server = $value['server'];
            $this->user = $value['user'];
            $this->password = $value['password'];
            $this->database = $value['database'];
            $this->port = $value['port'];
        }
        $this->conexion = new mysqli($this->server,$this->user,$this->password,$this->database);
        if($this->conexion->connect_errno){
            echo "No se pudo conectar a la DB";
            die();
        }
        $results = $this->conexion->query($sqlstr);
         $filas = $this->conexion->affected_rows;
         if($filas >= 1){
            return $this->conexion->insert_id;
         }else{
             return 0;
         }
    }
     
    //encriptar
    protected function encriptar($string){
        return md5($string);
    }


    public function insertarToken($usuarioid){
        $val = true;
        $token = bin2hex(openssl_random_pseudo_bytes(16,$val));
        $date = date("Y-m-d H:i");
        $estado = "Activo";

        $query = "DELETE FROM usuarios_token where UsuarioId = $usuarioid";
        $verifica = $this->nonQuery($query);

        $query = "INSERT INTO usuarios_token (UsuarioId,Token,Estado,Fecha)VALUES('$usuarioid','$token','$estado','$date')";
        $verifica = $this->nonQuery($query);
        if($verifica){
            return $token;
        }else{
            return 0;
        }
    }

    public function buscarToken($token){
        $query = "SELECT  TokenId,UsuarioId,Estado from usuarios_token WHERE Token = '" . $token . "' AND Estado = 'Activo'";
        $resp = $this->obtenerDatos($query);
        if($resp){
            return $resp;
        }else{
            return 0;
        }
    }


    public function actualizarToken($tokenid){
        $date = date("Y-m-d H:i");
        $query = "UPDATE usuarios_token SET Fecha = '$date' WHERE TokenId = '$tokenid' ";
        $resp = $this->nonQuery($query);
        if($resp >= 1){
            return $resp;
        }else{
            return 0;
        }
    }

}
