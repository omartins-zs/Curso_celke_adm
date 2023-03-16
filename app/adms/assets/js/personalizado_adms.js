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
