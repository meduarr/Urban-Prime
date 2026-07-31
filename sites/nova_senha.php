<?php

include("../php/conexao.php");

$erro = "";
$sucesso = "";

$token = "";

if(isset($_GET['token'])){

    $token = $_GET['token'];

}


// mensagem de erro
if(isset($_GET['erro'])){

    if($_GET['erro'] == "senhas") {

        $erro = "❗ As senhas não coincidem.";

    }

    if($_GET['erro'] == "igual") {

        $erro = "❗ A nova senha deve ser diferente da senha atual.";

    }

}

// mensagem de sucesso
if(isset($_GET['sucesso'])){

    if($_GET['sucesso'] == "senha") {

        $sucesso = "✅ Senha alterada com sucesso!";

        echo "
        <script>
        window.history.replaceState(null, null, 'nova_senha.php?token=$token');
        </script>
        ";

    }

}


// validar token
if(!empty($token)){


    $sql = "SELECT * FROM usuarios 
            WHERE token_recuperacao = ? 
            AND token_expira > NOW()";


    $stmt = $conexao->prepare($sql);


    $stmt->bind_param("s", $token);


    $stmt->execute();


    $resultado = $stmt->get_result();



    if($resultado->num_rows == 0){

        echo "Link inválido ou expirado.";
        exit();

    }


}else{

    echo "Token não encontrado.";
    exit();

}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Urban Prime | Senha</title>
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
           <h3 class="main-title" id="login">Nova senha</h3>
            <form action="../php/trocar_senha.php" method="POST" id="formSenha" class="form-login">
                <div class="mb-3">
                <label for="senha" class="form-label">Nova senha</label>
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
                <div class="input-group">
                  <span class="input-group-text" style="cursor: pointer;">
                    <i class="fas fa-lock"></i>
                  
                  </span><br>
                  <input 
                    type="password"
                    class="form-control"
                    id="novaSenha"
                    name="senha"
                    autocomplete="new-password"
                    placeholder="Digite sua senha"
                    required        minlength="8"
      pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$"
      title="A senha deve ter no mínimo 8 caracteres, contendo letras, números e caracteres especiais."
                  />
                  <span class="input-group-text togglePassword" style="cursor: pointer;">
                  <i class="fas fa-eye"></i>
                  </span>
                </div>
              </div>
              <div class="mb-3">
                <label for="confirmarSenha" class="form-label">Confirme sua senha</label>
                <div class="input-group">
                  <span class="input-group-text">
                    <i class="fas fa-lock"></i>
                  </span>
                  <input 
                    type="password"
                    class="form-control"
                    id="confirmarSenha"
                    name="confirmarSenha"
                    autocomplete="new-password"
                    placeholder="Confirme sua senha"
                    required        minlength="8"
      pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$"
      title="A senha deve ter no mínimo 8 caracteres, contendo letras, números e caracteres especiais."
                  />
                  <span class="input-group-text togglePassword" style="cursor: pointer;">
                  <i class="fas fa-eye"></i>
                  </span>
                </div>
              </div>
              <div
                class="d-flex justify-content-between align-items-center mb-3"
              >
                <a href="../sites/cadastro.php" class="text-decoration-none small" id="cadastro"
                  >Não tem conta? <span class="cadastro" > Cadastre-se</span> </a
                >
              </div>
              <input type="hidden" name="token" value="<?php echo $token; ?>">
              <button type="submit" class="main-btn">Redefinir senha</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    </div>
  </body>
<script src="../js/nvsenha.js"></script>
</html>

