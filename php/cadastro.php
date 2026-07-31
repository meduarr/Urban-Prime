<?php

// Permite acesso apenas pelo formulário
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Acesso inválido.");
}

require "conexao.php";

// Recebe os dados do formulário
$nome = $_POST["nome"];
$sobrenome = $_POST["sobrenome"];
$email = $_POST["email"];

// Verifica se as senhas são iguais
if ($_POST["senha"] !== $_POST["confirmarSenha"]) {
    die("As senhas não coincidem.");
}

// Criptografa a senha
$senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

// Verifica se o e-mail já existe
$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = mysqli_prepare($conexao, $sql);

mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($resultado) > 0) {
    die("E-mail já cadastrado!");
}

// Insere o usuário no banco
$sql = "INSERT INTO usuarios (nome, sobrenome, email, senha)
VALUES (?, ?, ?, ?)";

$stmt = mysqli_prepare($conexao, $sql);

mysqli_stmt_bind_param($stmt, "ssss", $nome, $sobrenome, $email, $senha);

if (mysqli_stmt_execute($stmt)) {
    header("Location: ../sites/login.html");
    exit();
} else {
    echo "Não foi possível realizar o cadastro. Tente novamente mas tarde. " . mysqli_error($conexao);
}
?>