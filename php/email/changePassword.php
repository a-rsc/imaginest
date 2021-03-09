<?php

// modificat C:/php-7.4.10/php.ini -> include_path = ".;c:\php\includes;C:\Users\a_rsc"

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
// require 'vendor/autoload.php';
$mail = new PHPMailer();

try{
    $mail->IsSMTP();

    // Configuraci�n del servidor de correo
    // Modificar a 0 para eliminar el mensaje de error
    $mail->SMTPDebug = EMAIL['EMAIL_SMTPDEBUG'];
    $mail->SMTPAuth = EMAIL['EMAIL_SMTPAUTH'];
    $mail->SMTPSecure = EMAIL['EMAIL_SMSMTPSECURE'];
    $mail->Host = EMAIL['EMAIL_HOST'];
    $mail->Port = EMAIL['EMAIL_PORT'];

    // Credenciales de la cuenta de gmail
    $mail->Username = EMAIL['EMAIL_USERNAME'];
    $mail->Password = EMAIL['EMAIL_PASSWORD'];

    // Datos del email
    $mail->SetFrom(EMAIL['EMAIL_SETFROM'], CONFIG['APP_NAME']);
    $mail->Subject = "Changed Password (" . CONFIG['APP_NAME'] . ')';

    $mail->IsHTML(true);

    require_once('../php/email/changePasswordHTML.php');

    // Body: Establece el cuerpo del mensaje.Puede ser texto simple o con formato HTMl. Si es con formato HTMl hay que ejecutar el m�todo IsHTML(True)
    $mail->Body = sprintf($body, CONFIG['APP_NAME'], CONFIG['URL'] . CONFIG['APP_IMAGE'], CONFIG['URL'], CONFIG['URL']);

    // AltBody: Establece el cuerpo del mensaje como s�lo de texto
    // $mail->AltBody = "This paragraph is not bold.\n\nThis text is not italic.";
    // $mail->addAttachment("fitxer.pdf");

    // Destinatario
    $address = $_SESSION['user']['email'];
    $mail->AddAddress($address, 'Email');

    // Env�o
    $mail->send();

}catch (Exception $e) {
    echo "Error: {$mail->ErrorInfo}";
}
