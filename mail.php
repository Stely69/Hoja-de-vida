<?php

    require 'phpmailer/PHPMailer.php';
    require 'phpmailer/Exception.php';
    require 'phpmailer/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    $nombre = $_POST['Nombre'];
    $email = $_POST['Email'];
    $asunto = $_POST['Asunto'];
    $mensajes = $_POST['Mensaje'];

    $ProtocoloSMTP_Automatico = true;
    $Email_Origen = 'williamsteven237g@gmail.com';
    $Password_Email_Origen = 'nrbznmshhikxjgra';

    $ProtocoloSMTP_Seguridad = "tls";  
    $ServidorCorreo_Host = "smtpgmail.com";        
    $ServidorCorreo_Port = 587;

    $body = <<<HTML
        <h1>Contacto desde la web </h1> 
        <p>De: $nombre / $email</p>
        <h2>Mensaje  </h2>
        $mensajes
    HTML;

    if(empty(trim($nombre)) )  $nombre='anonimo';

    $mailer = new PHPMailer (true);

    try {
        $mailer->SMTPDebug = 0;                      //Enable verbose debug output
        $mailer->isSMTP();                                            //Send using SMTP
        $mailer->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mailer->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mailer->Username   = 'williamsteven237g@gmail.com';                     //SMTP username
        $mailer->Password   = 'nrbznmshhikxjgra';                               //SMTP password
        $mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mailer->Port       = 465;
        
        $mailer->isHTML(true);
    
        $mailer -> setFrom($email, "$nombre");
        $mailer -> addAddress('williamsteven237g@gmail.com','Sitio web');
        $mailer -> Subject = "Mensaje web: $asunto";
        $mailer -> msgHTML($body);
        $mailer -> AltBody = strip_tags($body);
        
        $rta = $mailer -> send();
        echo'Message has been sent';  
    }catch (Exception $e){
        echo "Message could not be sent. Mailer Error: {$mailer->ErrorInfo}";
    }
    
    
    
   
 

?>