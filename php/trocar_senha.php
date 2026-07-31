<?php

include("conexao.php");


if($_SERVER["REQUEST_METHOD"] == "POST"){

    $senha = $_POST['senha'];
    $token = $_POST['token'];


    // procura usuário pelo token
    $sql = "SELECT * FROM usuarios 
            WHERE token_recuperacao = ?
            AND token_expira > NOW()";


    $stmt = $conexao->prepare($sql);

    $stmt->bind_param("s", $token);

    $stmt->execute();

    $resultado = $stmt->get_result();


    if($resultado->num_rows == 0){

        echo "Token inválido ou expirado.";
        exit();

    }


    // pega os dados do usuário
    $usuario = $resultado->fetch_assoc();



    // verifica se a nova senha é igual a antiga
    if(password_verify($senha, $usuario['senha'])){

        header("Location: ../sites/nova_senha.php?erro=igual&token=".$token);
        exit();

    }



    // cria a nova senha criptografada
    $novaSenha = password_hash($senha, PASSWORD_DEFAULT);



    // atualiza senha e remove token
    $sqlUpdate = "UPDATE usuarios SET 
                  senha = ?, 
                  token_recuperacao = NULL,
                  token_expira = NULL
                  WHERE id = ?";


    $stmtUpdate = $conexao->prepare($sqlUpdate);


    $stmtUpdate->bind_param(
        "si",
        $novaSenha,
        $usuario['id']
    );


    if($stmtUpdate->execute()){


        header("Location: ../sites/login.php?sucesso=senha");
        exit();


    } else {

        echo "Erro ao alterar senha.";

    }


}

?>
