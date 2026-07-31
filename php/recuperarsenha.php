<?php

require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'conexao.php';
include 'enviar_email.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];


    // procurar usuário pelo email
    $sql = "SELECT * FROM usuarios WHERE email = ?";

    $stmt = $conexao->prepare($sql);

    $stmt->bind_param("s", $email);

    $stmt->execute();

    $resultado = $stmt->get_result();

   if ($resultado->num_rows > 0) {

    // gerar token único
    $token = bin2hex(random_bytes(32));


    // validade de 1 hora
    $expira = date("Y-m-d H:i:s", strtotime("+1 hour"));


    // salvar token no banco
    $sql = "UPDATE usuarios 
            SET token_recuperacao = ?, token_expira = ?
            WHERE email = ?";


    $stmt = $conexao->prepare($sql);

    $stmt->bind_param(
        "sss",
        $token,
        $expira,
        $email
    );


    if ($stmt->execute()) {


     enviarEmail($email, $token);


     echo "Link de recuperação enviado para seu e-mail.";


}   else {

     echo "Erro ao salvar token.";

}
}

    }

?>