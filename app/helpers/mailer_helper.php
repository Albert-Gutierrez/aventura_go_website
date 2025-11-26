<?php
// Incluye la configuración de la base de datos
require_once __DIR__ . '/../../config/database.php';

// Autoload de Composer para cargar PHPMailer
require __DIR__ . '/../../vendor/autoload.php';

// Importa las clases necesarias de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function mailer_init()
{
    $mail = new PHPMailer(true);
    //Server settings
    $mail->SMTPDebug = 0;                               //Enable verbose debug output
    $mail->isSMTP();                                    //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';               //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                           //Enable SMTP authentication
    $mail->Username   = 'aventurago.contacto@gmail.com'; //SMTP username
    $mail->Password   = 'wewjiourqboyxypu';             //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    //Enable implicit TLS encryption
    $mail->Port       = 465;
    $mail->CharSet    = "UTF-8";
    $mail->isHTML(true);                        //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS

    return $mail;                    // Aquí puedes inicializar configuraciones comunes para el mailer si es necesario
}
