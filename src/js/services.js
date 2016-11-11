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
      if (!result.posts) {
        $('.posts').append('<div/>').addClass('text-center').text('Você não possui publicações');
      }
      else {
        $('.posts > div').length > 0 ? $('.posts > div').remove() : null;

        for (var i = 0; i < result.posts.length; i++) {
          var a = i+1;
          $('.posts').append('<div/>');
          $('.posts > div').eq(i).addClass('panel panel-default');
          $('.posts > div').eq(i).append('<div/> <div/>');
          $('.posts > div:nth-child('+a+') > div:nth-child(1)').addClass('panel-heading');
          $('.posts > div:nth-child('+a+') > div:nth-child(2)').addClass('panel-body');
          $('.posts > div:nth-child('+a+') > div.panel-heading').append('<div/>');
          $('.posts > div:nth-child('+a+') > div.panel-heading > div').addClass('row');
          $('.posts > div:nth-child('+a+') > div.panel-heading > div.row').append('<div/> <div/>');
          $('.posts > div:nth-child('+a+') > div.panel-heading > div > div').addClass('col-lg-6 col-md-6');
          $('.posts > div:nth-child('+a+') > div.panel-heading > div > div:nth-child(1)').text(result.posts[i].titulo);
          $('.posts > div:nth-child('+a+') > div.panel-heading > div > div:nth-child(2)').append('<div/>');
          $('.posts > div:nth-child('+a+') > div.panel-heading > div > div:nth-child(2) > div').addClass('text-right');
          $('.posts > div:nth-child('+a+') > div.panel-heading > div > div:nth-child(2) > div').append('<button onclick=editar('+result.posts[i].cod+') class="btn btn-primary">Editar<button/>');
          $('.posts > div:nth-child('+a+') > div.panel-heading > div > div:nth-child(2) > div').append('<button onclick=apagar('+result.posts[i].cod+') class="btn btn-danger">Apagar<button/>');
          $('.posts > div:nth-child('+a+') > div:nth-child(2)').text(result.posts[i].descricao);
        }
      }
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
        $('#imagem, #titulo, #descricao').val("");
      }
      else {
        mensagem("alert-danger", result.mensagem, 2500);
      }
    });
  }

  this.apagar = function(cod){
    $.ajax({
      method:'POST',
      url: 'src/php/post/apagar.php',
      data: 'codigo='+cod
    }).done(function(result){
      if (!result.erro) {
        mensagem("alert-success", 'Post deletado com sucesso!!', 2500);
        post.listar();
      }
      else {
        mensagem("alert-danger", result.mensagem, 2500);
      }
    });
  }
}

function mensagem(classe, mensagem, tempo){
  $('#mensagem').addClass(classe);
  $("#mensagem, .navMensagem").fadeIn();
  $('#mensagem > strong, #mensagem > div > div > strong').text(mensagem);

  setTimeout(function(){
    $("#mensagem, .navMensagem").fadeOut();
    setTimeout(function(){
      $('#mensagem').removeClass(classe);
    }, 1000);
  }, tempo);
}
