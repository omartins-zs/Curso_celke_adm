$(document).ready(function () {
  $("#newUser").on("submit", function () {
    if ($("#name").val() === "") {
      $(".msg").html("<p>Erro: Necessário preencher o campo nome!</p>");
      return false;
    } else if ($("#email").val() === "") {
      $(".msg").html("<p>Erro: Necessário preencher o campo e-mail!</p>");
      return false;
    } else if ($("#password").val() === "") {
      $(".msg").html("<p>Erro: Necessário preencher o campo senha!</p>");
      return false;
    }
  });
});

$(document).ready(function () {
  $("#sendLogin").on("submit", function () {
    if ($("#user").val() === "") {
      $(".msg").html("<p>Erro: Necessário preencher o campo usuário!</p>");
      return false;
    } else if ($("#password").val() === "") {
      $(".msg").html("<p>Erro: Necessário preencher o campo senha!</p>");
      return false;
    }
  });
});

function passwordStrength() {
  var password = document.getElementById("password").value;
  var strength = 0;

  if (password.length >= 6 && password.length <= 7) {
    strength += 10;
  } else if (password.length > 7) {
    strength += 25;
  }

  if (password.length >= 6 && password.match(/[a-z]+/)) {
    strength += 10;
  }

  if (password.length >= 7 && password.match(/[A-Z]+/)) {
    strength += 20;
  }

  if (password.length >= 8 && password.match(/[@#$%&;*]+/)) {
    strength += 25;
  }

  if (password.match(/([1-9]+)\1{1,}/)) {
    strength += -25;
  }

  console.log(strength);
  viewStrength(strength);
}
