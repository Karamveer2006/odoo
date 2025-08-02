<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../magic_mailer/autoload.php';
class MailController extends Controller
{
    public static function msc_mailer($to,$subject, $msg,$email_head = null,$attachment=null,$file_tmp_name=null,$file_name=null){
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = false;                   //Enable verbose debug output
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = '';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = env("MAIL_USERNAME");                     //SMTP username
            $mail->Password   = env("MAIL_PASSWORD");                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = env("MAIL_PORT");                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom(env("MAIL_FROM_ADDRESS"),$email_head ?? env("MAIL_FROM_NAME"));
            $mail->addAddress($to);     //Add a recipient              //Name is optional
            // $mail->addReplyTo('info@msoftcode.com', 'Support Team');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
        
            //Attachments
            //   if($attachment=="yes"){
            //         $mail->addAttachment($file_tmp_name, $file_name);
            //     }
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $msg;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            if($mail->Send()){
                return true;
            }else{
                // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                return false;
            }
        } catch (Exception $e) {
            return false;       
        }
    }
}
