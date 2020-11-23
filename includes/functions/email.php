<?php
require_once "../../init.php";
require_once DIR."/classes/DB.php";
$db = new DB();   
$email = $_POST['email'];
$query = "SELECT `TOKEN` FROM `usuario` WHERE `email` = '$email' LIMIT 1";
$result = $db->consultar($query,$db);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if($ln = $result->fetch_assoc()){
   

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    $mail = new PHPMailer;
    
    $mail->SMTPDebug = 5;                               
    //Set PHPMailer to use SMTP.
    $mail->isSMTP();            
    //Set SMTP host name                          
    $mail->Host = "smtp.live.com";
    //Set this to true if SMTP host requires authentication to send email
    $mail->SMTPAuth = true;     
    $mail->SMTPSecure = "tls";                           

    //Provide username and password     
    $mail->Username = "felipe_a.almeida@outlook.com";                 
    $mail->Password = "senha12679";                           
    //Set TCP port to connect to 
    $mail->Port = 587;                                   

    $mail->From = "felipe_a.almeida@outlook.com";
    $mail->FromName = "UNIARARAS";

    $mail->smtpConnect(
        array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
            )
        )
    );

    $mail->addAddress($email);

    $mail->isHTML(true);

    $mail->Subject = "Recuperar Senha";
    $mail->Body = '


        <div>
            <div style="height:50px; background-color:#42576f;padding:15px;text-align:center;">
                <img src="https://iili.io/d2CHCl.png" alt="Logo da FHO UNIARARAS" style="vertical-align: middle">        
            </div>
            <br><br>
            <div>
                <p>
                    Prezado Usu&aacute;rio,        
                </p>
                <br>
                <p>
                    Identificamos uma solicita&ccedil;&atilde;o para recupera&ccedil;&atilde;o de senha para seu usu&aacute;rio em nosso sistema de cl&iacute;nicas
                </p>
                <br>
                <p>
                    Clique no bot&atilde;o abaixo para recupera&ccedil;&atilde;o de senha:
                </p>
                <br>
                <a href="'.URL_BASE.'/recuperaSenha.php?token='.$ln['TOKEN'].'">
                    <button type="button" style="height: 50; text-aling:center;background-color:#42576f;color:white;font-weight:600; width:150px;">
                        Clique aqui
                    </button>
                </a>
                <br>
            </div>
        </div>
    ';

    /*if(!$mail->send()) 
    {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } 
    else 
    {
        echo "Foi";
    }*/

}else{
    return false;
}
?>

