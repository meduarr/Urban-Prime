<?php

include("../php/conexao.php");

mysqli_report(MYSQLI_REPORT_OFF);

$erro = "";
$sucesso = "";

if (isset($_GET['erro']) && $_GET['erro'] == "email") {
    $erro = "❗Este e-mail já está cadastrado. Faça o login.";
}
if (isset($_GET['cadastro']) && $_GET['cadastro'] == "sucesso") {
    $sucesso = "✅ Cadastro realizado com sucesso! Faça seu login.";
}
if (isset($_GET['sucesso']) && $_GET['sucesso'] == "senha") {
    $sucesso = "✅ Senha alterada com sucesso! Faça seu login.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Procura o usuário pelo e-mail
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";

    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) == 1) {

        // Pega os dados do usuário encontrado
        $usuario = mysqli_fetch_assoc($resultado);

        // Verifica se a senha digitada é igual à senha criptografada do banco
        if (password_verify($senha, $usuario['senha'])) {

            // Login realizado com sucesso
            header("Location: loja.html");
            exit;

        } else {

            $erro = "❗E-mail ou senha inválidos.";

        }

    } else {

        $erro = "❗E-mail ou senha inválidos.";

    }

}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Urban Prime | Login</title>
    <!--bootstrap-->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
      crossorigin="anonymous"
    />
    <!--css-->
    <link rel="stylesheet" href="../css/prime.css" />

    <!--biblioteca JS-->
    <script
      src="https://code.jquery.com/jquery-4.0.0.min.js"
      integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao="
      crossorigin="anonymous"
    ></script>

    <!--JavaScript do Bootstrap-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
      crossorigin="anonymous"
    ></script>

    <!--Font Awesome-->
    <!--permite ✔ Check e etc-->
    <script
      src="https://kit.fontawesome.com/491f37b692.js"
      crossorigin="anonymous"
    ></script>
    <!--Progress Bar, Barra horizontal [████████░░░░░░░░] 50%-->
    <script src="js/progressbar.min.js"></script>

    <!--Parallax, o fundo se move em uma velocidade diferente, permite as imagens passarem-->
    <script src="https://cdn.jsdelivr.net/parallax.js/1.4.2/parallax.min.js"></script>
  </head>
  <body class="bodys" style="background-color: black">
    <header>
      <div class="container" id="nav-container">
        <nav class="navbar navbar-expand-lg fixed-top">
          <a href="#" class="navbar-brand">
            <img id="logo" src="../img/logotest.png" alt="UrbanPrime" /> Urban
            Prime
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbar-links"
            aria-controls="navbar-links"
            aria-expanded="false"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div
            class="collapse navbar-collapse justify-content-end"
            id="navbar-links"
          >
            <div class="navbar-nav navbar-brand">
              <a class="nav-item nav-link" href="../sites/index.html">Home</a>
              <a class="nav-item nav-link" href="../sites/login.php"> Login</a>
              <a class="nav-item nav-link" href="../sites/produtos.html"
                >Vitrine</a
              >
              <a class="nav-item nav-link" href="../sites/novidades.html"
                >Contato</a
              >
              <a class="nav-item nav-link" href="../sites/time.html">Time</a>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <div class="container login-container">
      <div class="row justify-content-center">
        <div class="col-11 col-sm-10 col-md-8 col-lg-6">
          <div class="card card-body p4 form-card">
           <h3 class="main-title" id="login">Login</h3>
           <?php if (!empty($sucesso)) { ?>
            <div class="alert alert-success" id="sucesso">
           <?php echo $sucesso; ?>
           </div>
           <?php } ?>
           <?php if (!empty($erro)) { ?>
            <div class="alert alert-danger" id="erro">
            <?php echo $erro; ?>
            </div>
          <?php } ?>
            <form class="form-login"  action="../sites/login.php" method="POST">
              <div class="mb-3">
                <label for="email" class="form-label"> E-mail</label>
                <div class="input-group">
                  <span class="input-group-text">
                    <i class="fas fa-envelope"></i>
                  </span>
                  <input
                    type="email"
                    name="email"
                    class="form-control"
                    id="email"
                    placeholder="Digite seu e-mail"
                    required
                  />
                </div>
                 <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <div class="input-group">
                  <span class="input-group-text">
                    <i class="fas fa-lock"></i>
                  
                  </span>
                  <input 
                    type="password"
                    class="form-control"
                    id="senha"
                    name="senha"
                    placeholder="Digite sua senha"
                    required        minlength="8"
      pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$"
      title="A senha deve ter no mínimo 8 caracteres, contendo letras, números e caracteres especiais."
                  />
                  <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                  <i class="fas fa-eye" id="olho"></i>
                  </span>
                </div>
              </div>
              <div
                class="d-flex justify-content-between align-items-center mb-3"
              >
                <a href="../sites/nvsenha.php" class="text-decoration-none small" id="nvsenha"
                  >Esqueci minha senha</a
                >
                <a href="../sites/cadastro.php" class="text-decoration-none small" id="cadastro"
                  >Não tem conta?<span class="cadastro" > Cadastre-se</span></a
                >
              </div>

              <button type="submit" class="main-btn">Entrar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    </div>
  </body>
  <script src="../js/script.js"></script>
  <script>
setTimeout(() => {
    const erro = document.getElementById("erro");

    if (erro) {
        erro.style.display = "none";
    }
}, 5000);
</script>
<script>
  setTimeout(() => {
    const sucesso = document.getElementById("sucesso");
    if (sucesso) {
        sucesso.style.display = "none";
    }
}, 5000);
</script>
</html>
