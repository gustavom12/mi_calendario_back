<?php 

class respuestas{

    public  $response = [
        'status' => "ok",
        "result" => array()
    ];

    //Metodo no permitido
    public function error_405(){
        $this->response['status'] = "error";
        $this->response['result'] = array(
            "error_id" => "405",
            "error_msg" => "Metodo no permitido"
        );
        return $this->response;
    }

    //Faltan datos o datos incorrectos del usuario
    public function error_200($valor = "Datos incorrectos"){
        $this->response['status'] = "error";
        $this->response['result'] = array(
            "error_id" => "200",
            "error_msg" => $valor
        );
        return $this->response;
    }

    //Faltan datos o formato incorrecto
    public function error_400($valor = "Datos enviados incompletos o con formato incorrecto"){
        $this->response['status'] = "error";
        $this->response['result'] = array(
            "error_id" => "400",
            "error_msg" => $valor
        );
        return $this->response;
    }

    //Error de DB
    public function error_500($valor = "Error interno del servidor"){
        $this->response['status'] = "error";
        $this->response['result'] = array(
            "error_id" => "500",
            "error_msg" => $valor
        );
        return $this->response;
    }

    //Metodo no autorizado por el usuario
    public function error_401($valor = "No autorizado"){
        $this->response['status'] = "error";
        $this->response['result'] = array(
            "error_id" => "401",
            "error_msg" => $valor
        );
        return $this->response;
    }
}

?>