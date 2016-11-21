var usuario = new Usuario();
var post = new Post();
var pathname = $(location).attr('pathname');
var formLogin = $('#formLogin');
var formInserirPost = $('#inserirPost');
var formAtualizarPost = $('#atualizarPost');
var url = [
  '/estudo/',
  '/estudo/index',
  '/estudo/inserir',
  '/estudo/editar',
  '/estudo/index.html',
  '/estudo/inserir.html',
  '/estudo/editar.html',
];

(function($){
	$(function(){
    formLogin.submit(function(els){
        usuario.login(els);
    });

    formInserirPost.submit(function(els){
        post.inserir(els);
    });

    formAtualizarPost.submit(function(els){
      post.atualizar(els);
    })

    for(var i=0; i < url.length; i++){
      if (pathname == url[i]) {
        usuario.sessao();
      }
    }

    if (pathname == url[0] || pathname == url[1]) {
      post.listar();
    }

    if (pathname == url[3] || pathname == url[4]) {
      var endereco = window.location.href.split('?');
      post.editar(endereco[1]);
    }

    $('.sair').click(function(){
      usuario.logout();
    });
	});
})(jQuery);

function editar(valor){
  post.editar()
}

function apagar(valor){
  if (confirm('Tem certeza que deseja apagar esta publicação?')) {
    post.apagar(valor);
  }
}
