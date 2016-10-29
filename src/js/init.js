var usuario = new Usuario();
var pathname = $(location).attr('pathname');
var formLogin = $('#formLogin');


(function($){
	$(function(){
    formLogin.submit(function(els){
        usuario.login(els);
    });

    if (pathname == '/crud_ajax/' || pathname == '/crud_ajax/index.html') {
      usuario.sessao();
    }

    $('.sair').click(function(){
      usuario.logout();
    });
	});

})(jQuery);
