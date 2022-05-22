<?php
namespace App;

require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

use App\Credentials;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer {

    public function enviaEmail($toEmailAddress, $toName, $bodyHTML, $mailSubject = 'E-mail da FAUA', $mailfromName = 'FAUA', $fromMail = Credentials::mailEmail) {

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF; //DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = Credentials::mailSMTP;                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = Credentials::mailEmail;                     //SMTP username
        $mail->Password   = Credentials::mailPass;                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = Credentials::mailPortSMTP;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($fromMail, $mailfromName);
        $mail->addAddress($toEmailAddress, $toName);     //Add a recipient        //Name is optional

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $mailSubject;
        $mail->Body    = "<h1>Olá $toName</h1>";
        $mail->Body    .= file_get_contents('../views/mail/' . $bodyHTML . '.html');
        $mail->AltBody = 'Você precisa de um email que aceite HTML para visualizar este email.';

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
}
?>