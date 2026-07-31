$(".togglePassword").click(function () {
  let input = $(this).siblings("input");

  if (input.attr("type") === "password") {
    input.attr("type", "text");
    $(this).find("i").removeClass("fa-eye").addClass("fa-eye-slash");
  } else {
    input.attr("type", "password");
    $(this).find("i").removeClass("fa-eye-slash").addClass("fa-eye");
  }
});

$("#formSenha").submit(function (e) {
  let senha = $("#novaSenha").val();
  let confirmar = $("#confirmarSenha").val();

  if (senha !== confirmar) {
    e.preventDefault();

    let token = $("input[name='token']").val();

    window.location.href = "nova_senha.php?erro=senhas&token=" + token;
  }
});

setTimeout(() => {
  const erro = document.getElementById("erro");

  if (erro) {
    erro.style.display = "none";
  }
}, 5000);
