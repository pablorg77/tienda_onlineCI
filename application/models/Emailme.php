<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

class Loginuser extends CI_Model{

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

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
            
            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            $mail->isHTML(true);                                
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
            //redirect('mycart');
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
}