<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../vendor/autoload.php";


function enviarEmail($email, $token){

$mail = new PHPMailer(true);

try {

    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;

    $mail->Username = "mariaeduar03042006@gmail.com";
    $mail->Password = "yuloobixrktiqdac";

    $mail->SMTPSecure = "tls";
    $mail->Port = 587;


    $mail->setFrom(
        "mariaeduar03042006@gmail.com",
        "Urban Prime"
    );


    // agora o e-mail vem do usuário
    $mail->addAddress($email);


    $mail->isHTML(true);

    $mail->Subject = "Recuperação de senha - Urban Prime";


    $link = "http://localhost/URBANPRIME/sites/nova_senha.php?token=" . $token;


    $mail->Body = "
        <h2>Urban Prime</h2>

        <p>Você solicitou a troca de senha.</p>

        <p>Clique no link abaixo:</p>

        <a href='$link'>
            Trocar minha senha
        </a>

    ";


    $mail->send();


} catch (Exception $e) {

    echo "Erro: " . $mail->ErrorInfo;

}

}

?>