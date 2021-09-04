<?php
require_once 'clases/conexion/conexion.php';
require_once 'clases/respuestas.class.php';
require_once 'clases/envio_mail.class.php';

class configuracion_registrar extends conexion
{
    private $table = 'configuracion_turnos';
    private $query = '';

    private $dia = 0;
    private $nombre = '';
    private $desde = '';
    private $hasta = '';
    private $desde_1 = '';
    private $hasta_1 = '';
    private $intervalo = '';

    private $queryConfiguracion = '';

    public function registrar($json)
    {
        $_respuestas = new respuestas;
        $datos = json_decode($json, true);
        // borro la tabla de configuraciones
        $this->query = "DELETE FROM " . $this->table;
        $resp = parent::nonQueryId($this->query);

        foreach ($datos as $value) {
            $this->dia = $value["dia"];
            $this->nombre = $value["nombre"];
            $this->desde = $value["desde"];
            $this->hasta = $value["hasta"];
            $this->desde_1 = $value["desde_1"];
            $this->hasta_1 = $value["hasta_1"];
            $this->intervalo = "15";

            $this->queryConfiguracion = "INSERT INTO " . $this->table . " (dia,nombre,desde,hasta,desde_1,hasta_1,intervalo) values (" . $this->dia . ",'" . $this->nombre . "','" . $this->desde . "','" . $this->hasta . "','" . $this->desde_1 . "','" . $this->hasta_1 . "'," . $this->intervalo . ");";

            $this->insertarConfiguracion();
        }
        $result = '';
        // si se guardo
        $result = $_respuestas->response;
        $result["result"] = array(
            "mensaje" => "Se actulizo la configuracion de turnos."
        );

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

// $this->query = "DELETE FROM " . $this->table;
//         $resp = parent::nonQueryId($this->query);
//         echo($datos[0]["turnos"][0]);
//         foreach ($datos as $value) {
//             $this->dia = $value["dia"];
//             $this->nombre = $value["nombre"];
//             if($value["turnos"][0]){
//                 $this->desde = $value["turnos"][0] -> inicio;
//                 $this->hasta = $value["turnos"][0] -> fin;
//             }else{
//                 $this->desde = "00:00";
//                 $this->hasta = "00:00";
//             }
//             //Si existe un segundo desde hasta
//             if($value["turnos"][1]){
//                 $this->desde_1 = $value["turnos"][1] -> inicio;
//                 $this->hasta_1 = $value["turnos"][1] -> fin;
//             }else{
//                 $this->desde_1 = "00:00";
//                 $this->hasta_1 = "00:00";
//             }
//             $this->intervalo = "30";
            
//             $this->queryConfiguracion = "INSERT INTO " . $this->table . " (dia,nombre,desde,hasta,desde_1,hasta_1,intervalo) values (" . $this->dia . ",'" . $this->nombre . "','" . $this->desde . "','" . $this->hasta . "','" . $this->desde_1 . "','" . $this->hasta_1 . "'," . $this->intervalo . ");";

//             $this->insertarConfiguracion();
//         }