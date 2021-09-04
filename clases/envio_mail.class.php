<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$mail = new PHPMailer(TRUE);

class envio_mail{
    // Datos de la cuenta de correo utilizada para enviar vía SMTP
    private $smtpHost = "c2280675.ferozo.com";  // Dominio alternativo brindado en el email de alta 
    private $smtpUsuario = "soporte@codecash.com.ar";  // Mi cuenta de correo
    private $emailFrom = "soporte@codecash.com.ar";
    private $smtpClave = "@YAfCH04uF";  // Mi contraseña

    public $correo = '';
    public $mensaje = '';
    public $subjet = '';

    public function enviar_correo(){

        // Email donde se enviaran los datos cargados en el formulario de contacto
        $emailDestino = $this->correo;

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Port = 465; 
        $mail->SMTPSecure = 'ssl';
        $mail->IsHTML(true); 
        $mail->CharSet = "utf-8";


        // VALORES A MODIFICAR //
        $mail->Host = $this->smtpHost; 
        $mail->Username = $this->smtpUsuario; 
        $mail->Password = $this->smtpClave;

        $mail->From = $this->emailFrom; // Email desde donde envío el correo.
        $mail->FromName = $this->emailFrom;
        $mail->AddAddress($emailDestino); // Esta es la dirección a donde enviamos los datos del formulario

        $mail->Subject = $this->subjet; //"DonWeb - Ejemplo de formulario de contacto"; // Este es el titulo del email.
        $mensajeHtml = nl2br($this->mensaje);
        $mail->Body = "{$mensajeHtml}"; // Texto del email en formato HTML
        $mail->AltBody = "{$this->mensaje} \n\n"; // Texto sin formato HTML

        $estadoEnvio = $mail->Send(); 
        if($estadoEnvio){
            //echo "El correo fue enviado correctamente.";
        } else {
            //echo "Ocurrió un error inesperado.";
        }

    }
}

?>