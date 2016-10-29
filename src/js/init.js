var usuario = new Usuario();
var formLogin = $('#formLogin');


(function($){
	$(function(){

    formLogin.submit(function(els){
        usuario.login(els);
    });

	});

})(jQuery);
