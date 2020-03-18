<?php
define("URL_BASE","http://localhost/tcc/");
define("DIR","C:/xampp/htdocs/tcc/");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer;
 
$mail->SMTPDebug = 3;                               
//Set PHPMailer to use SMTP.
$mail->isSMTP();            
//Set SMTP host name                          
$mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                          
//Provide username and password     
$mail->Username = "lipi.aug12679@gmail.com";                 
$mail->Password = "senha12679";                           
//If SMTP requires TLS encryption then set it
//$mail->SMTPSecure = "tls";                           
//Set TCP port to connect to 
$mail->Port = 587;                                   

$mail->From = "lipi.aug12679@gmail.com";
$mail->FromName = "Felipe";

$mail->smtpConnect(
    array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
            "allow_self_signed" => true
        )
    )
);

$mail->addAddress("felipe_a.almeida@outlook.com");

$mail->isHTML(true);

$mail->Subject = "Recuperar Senha";
$mail->Body = '


    <div>
        <div style="height:50px; background-color:#42576f;padding:15px;text-align:center;">
            <img src="<?= URL_BASE ?>images/logoFHO.png" alt="Logo da FHO UNIARARAS" style="vertical-align: middle">        
        </div>
        <br><br>
        <div>
            <p>
                Prezado Usuário,        
            </p>
            <br>
            <p>
                Identificamos uma solicitação para recuperação de senha para seu usuário em nosso sistema de clínicas
            </p>
            <br>
            <p>
                Clique no botão abaixo para recuperação de senha:
            </p>
            <br>
            <button type="button" style="height: 50; text-aling:center;background-color:#42576f;color:white;font-weight:600; width:150px;">
                Clique aqui
            </button>
            <br>
        </div>
    </div>
';
$mail->AltBody = "This is the plain text version of the email content";

if(!$mail->send()) 
{
    echo "Mailer Error: " . $mail->ErrorInfo;
} 
else 
{
    echo "Foi";
    
}


?>

