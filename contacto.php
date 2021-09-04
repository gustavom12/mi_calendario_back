<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$mail = new PHPMailer(TRUE);

// Valores enviados desde el formulario
if ( !isset($_POST["nombre"]) || !isset($_POST["email"]) || !isset($_POST["mensaje"]) ) {
    die ("Es necesario completar todos los datos del formulario");
}

$nombre = $_POST["nombre"];
$email = $_POST["email"];
$mensaje = $_POST["mensaje"];

// Datos de la cuenta de correo utilizada para enviar vía SMTP
$smtpHost = "c2050209.ferozo.com";  // Dominio alternativo brindado en el email de alta 
$smtpUsuario = "info@gbsoft.com.ar";  // Mi cuenta de correo
$emailFrom = "info@gbsoft.com.ar";
$smtpClave = "Papaalf1";  // Mi contraseña

// Email donde se enviaran los datos cargados en el formulario de contacto
$emailDestino = $email;

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 465; 
$mail->SMTPSecure = 'ssl';
$mail->IsHTML(true); 
$mail->CharSet = "utf-8";


// VALORES A MODIFICAR //
$mail->Host = $smtpHost; 
$mail->Username = $smtpUsuario; 
$mail->Password = $smtpClave;

$mail->From = $emailFrom; // Email desde donde envío el correo.
$mail->FromName = $emailFrom;
$mail->AddAddress($emailDestino); // Esta es la dirección a donde enviamos los datos del formulario

$mail->Subject = "DonWeb - Ejemplo de formulario de contacto"; // Este es el titulo del email.
$mensajeHtml = nl2br($mensaje);
$mail->Body = "{$mensajeHtml} <br /><br />Formulario de ejemplo. By DonWeb<br />"; // Texto del email en formato HTML
$mail->AltBody = "{$mensaje} \n\n Formulario de ejemplo By DonWeb"; // Texto sin formato HTML
// FIN - VALORES A MODIFICAR //

$estadoEnvio = $mail->Send(); 
if($estadoEnvio){
    echo "El correo fue enviado correctamente.";
} else {
    echo "Ocurrió un error inesperado.";
}



?>
