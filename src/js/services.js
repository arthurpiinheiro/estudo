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
        mensagem("alert-danger", 'Usuário ou senha inválidos!!', 1000);
        $('#senha').val("");
      }
      else {
        $('#email, #senha').attr('disabled', 'disabled');
        mensagem("alert-success", 'Logado com sucesso!!', 1000);
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
}

function Post(){
  this.listar = function(){
    $.ajax({
      method:'GET',
      url: 'src/php/post/listar.php'
    }).done(function(result){
      console.log(result);
      console.log('foi');
    });
  }

  this.inserir = function(form){

    form.preventDefault();
    var formData = new FormData($("#inserirPost")[0]);

    $.ajax({
      method:'POST',
      url: 'src/php/post/inserir.php',
      processData: false,
      contentType: false,
      data: formData
    }).done(function(result){
      if (!result.erro) {
        mensagem("alert-success", 'Post cadastrado com sucesso!!', 2500);
        $('#titulo, #descricao').val("");
      }
      else {
        mensagem("alert-danger", result.mensagem, 2500);
      }
    });
  }
}

function mensagem(classe, mensagem, tempo){
  $('#mensagem').addClass(classe);
  $("#mensagem").fadeIn();
  $('#mensagem > strong').text(mensagem);

  setTimeout(function(){
    $("#mensagem").fadeOut();
    setTimeout(function(){
      $('#mensagem').removeClass(classe);
    }, 1000);
  }, tempo);
}
