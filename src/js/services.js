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
        $('#senha').val("");
      }
      else {
        $('#email, #senha').attr('disabled', 'disabled');
        mensagem("alert-success", 'Logado com sucesso!!');
        setTimeout(function(){
          window.location.href = "index.html";
        }, 1000);
      }
    });
  }

  this.sessao = function(){
    $.ajax({
      method:'POST',
      url: 'src/php/user/session.php'
    }).done(function(result){
      if (!result.session) {
        window.location.href = "login.html";
      }
      else{
        $('#index').fadeIn();
      }
    });
  }

  this.logout = function(){
    $.ajax({
      method:'GET',
      url: 'src/php/user/logout.php?session=logout'
    }).done(function(result){
      if (result.logout) {
        window.location.href = "login.html";
      }
    });
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

function Post(){

  this.listar = function(){
    $.ajax({
      method:'GET',
      url: 'src/php/post/listar.php'
    }).done(function(result){
      console.log(result);
    });
  }
}
