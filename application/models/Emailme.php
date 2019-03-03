<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Emailme extends CI_Model{
    
    
    /**
     * Mediante los parámetros asignados por parámetro, enviaría un correo al usuario específico con un cuerpo específico.
     * 
     * @param string $correo
     * @param string $user
     * @param string $subject
     * @param string $body
     */
    function emailsomeone($correo,$user,$subject,$body){

        //Load Composer's autoloader
        require 'vendor/autoload.php';

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP(true);                                  // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'prgdwes@gmail.com';                // SMTP username
            $mail->Password = 'proofness88';                      // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                    // TCP port to connect to

            $mail->setFrom('prgdwes@gmail.com', 'Administrador');
            $mail->addAddress($correo, $user);     

            $mail->isHTML(true);                                
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
    /**
     * Para enviar un correo con un archivo adjunto.
     * 
     * @param int $user
     * @param string $subject
     * @param string $body
     * @param string $attach
     */
    function emailWithAttach($user,$subject,$body,$attach){

        //Load Composer's autoloader
        require 'vendor/autoload.php';

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP(true);                                  // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'prgdwes@gmail.com';                // SMTP username
            $mail->Password = 'proofness88';                      // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                    // TCP port to connect to

            $mail->setFrom('prgdwes@gmail.com', 'Administrador');
            $mail->addAddress('prgdwes@gmail.com', $user);     
            
            //Attachments
            $mail->addAttachment($attach);         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            $mail->isHTML(true);                                
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
}