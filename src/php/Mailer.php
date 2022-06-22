<?php
namespace App;

require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

use App\Credentials;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer {

    public static function enviaEmail($params, $toEmailAddress, $toName, $bodyHTML, $mailSubject = 'E-mail da FAUA', $mailfromName = 'FAUA', $fromMail = Credentials::mailEmail) {

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
        $mail->CharSet = "UTF-8"; 
        $mail->Encoding = 'base64';

        //Recipients
        $mail->setFrom($fromMail, $mailfromName);
        $mail->addAddress($toEmailAddress, $toName);     //Add a recipient        //Name is optional
        $imagem = $_SERVER['DOCUMENT_ROOT'].'/src/assets/logo.png';
        $mail->AddEmbeddedImage($imagem, 'logo_ref');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $mailSubject;

        $randomness = rand(1, 900);
        ob_start();
        include($_SERVER['DOCUMENT_ROOT'].'/src/views/mail/'.$bodyHTML.'.php');
        $corpoHTML = ob_get_contents();
        ob_end_clean();

        $mail->Body = $corpoHTML;
        $mail->AltBody = 'Você precisa de um email que aceite HTML para visualizar este email.';

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
}
?>