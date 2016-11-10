var usuario = new Usuario();
var post = new Post();
var pathname = $(location).attr('pathname');
var formLogin = $('#formLogin');
var formInserirPost = $('#inserirPost');

var url = [
  '/estudo/',
  '/estudo/index.html',
  '/estudo/inserir.html'
];

(function($){
	$(function(){
    formLogin.submit(function(els){
        usuario.login(els);
    });

    formInserirPost.submit(function(els){
        post.inserir(els);
    });

    for(var i=0; i < url.length; i++){
      if (pathname == url[i]) {
        usuario.sessao();
      }
    }

    if (pathname == url[0] || pathname == url[1]) {
      post.listar();
    }

    $('.sair').click(function(){
      usuario.logout();
    });
	});

})(jQuery);

function editar(valor){
}

function apagar(valor){
  post.apagar(valor);
}
