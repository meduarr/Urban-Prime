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
