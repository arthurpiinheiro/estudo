function Usuario(){

  this.login = function(form){
    form.preventDefault();
    formData = $('#formLogin').serialize();

    $.ajax({
      method: 'POST',
      url: 'src/php/user/login.php',
      data: formData
    }).done(function(result){
      if (!result.login){
        mensagem("alert-danger", 'Usuário ou senha inválidos!!');
      }
      else {
        mensagem("alert-success", 'Logado com sucesso!!');
        setTimeout(function(){
          window.location.href = "index.html";
        }, 1000);
      }
    });
  }

  this.sessao = function(){

  }

  function mensagem(classe, mensagem){
    $('#mensagem').addClass(classe);
    $("#mensagem").fadeIn();
    $('#mensagem > strong').text(mensagem);

    setTimeout(function(){
      $("#mensagem").fadeOut();
      setTimeout(function(){
        $('#mensagem').removeClass(classe);
      }, 1000);
    }, 1000);
  }
}
