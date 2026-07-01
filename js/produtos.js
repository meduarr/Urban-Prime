//Filtrar botões dos produtos

$(".filter-btn").on("click", function () {
  let type = $(this).attr("id");
  let boxes = $(".project-box");

  $(".filter-btn").removeClass("active");
  $(this).addClass("active");

  if (type == "Nike-btn") {
    eachBoxes("Nike", boxes);
  } else if (type == "puma-btn") {
    eachBoxes("Puma", boxes);
  } else if (type == "adidas-btn") {
    eachBoxes("Adidas", boxes);
  } else {
    eachBoxes("all", boxes);
  }
});

function eachBoxes(type, boxes) {
  if (type == "all") {
    $(boxes).fadeIn();
  } else {
    $(boxes).each(function () {
      if (!$(this).hasClass(type)) {
        $(this).fadeOut("slow");
      } else {
        $(this).fadeIn();
      }
    });
  }
}
