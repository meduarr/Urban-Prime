$(document).ready(function () {
  let containerA = document.getElementById("CircleA");

  let CircleA = new ProgressBar.Circle(containerA, {
    color: "#fff",
    strokeWidth: 8,
    duration: 1400,
    from: { color: "#AAA" },
    to: { color: "#65DAF9" },

    step: function (state, circle) {
      circle.path.setAttribute("stroke", state.color);

      let value = Math.round(circle.value() * 500);

      circle.setText(value);
    },
  });

  let containerB = document.getElementById("CircleB");

  let CircleB = new ProgressBar.Circle(containerB, {
    color: "#fff",
    strokeWidth: 8,
    duration: 1600,
    from: { color: "#AAA" },
    to: { color: "#65DAF9" },

    step: function (state, circle) {
      circle.path.setAttribute("stroke", state.color);

      let value = Math.round(circle.value() * 450);

      circle.setText(value);
    },
  });
  let containerC = document.getElementById("CircleC");

  let CircleC = new ProgressBar.Circle(containerC, {
    color: "#fff",
    strokeWidth: 8,
    duration: 2000,
    from: { color: "#AAA" },
    to: { color: "#65DAF9" },

    step: function (state, circle) {
      circle.path.setAttribute("stroke", state.color);

      let value = Math.round(circle.value() * 300);

      circle.setText(value);
    },
  });
  let containerD = document.getElementById("CircleD");

  let CircleD = new ProgressBar.Circle(containerD, {
    color: "#fff",
    strokeWidth: 8,
    duration: 2200,
    from: { color: "#AAA" },
    to: { color: "#65DAF9" },

    step: function (state, circle) {
      circle.path.setAttribute("stroke", state.color);

      let value = Math.round(circle.value() * 120);

      circle.setText(value);
    },
  });

  //inicar o loader quando o usuario chegar no elemento.

  let dataAreaOffset = $("#data-area").offset();
  let stop = 0;

  $(window).scroll(function (e) {
    let scroll = $(window).scrollTop();

    if (scroll > dataAreaOffset.top - 500 && stop == 0) {
      CircleA.animate(1.0);
      CircleB.animate(1.0);
      CircleC.animate(1.0);
      CircleD.animate(1.0);

      stop = 1;
    }
  });
});
