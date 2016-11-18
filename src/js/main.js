$(function(){
  $('.thumbnail').click(function(){
    $('.lightbox').fadeIn();
    $('.loading').fadeOut();
    $('.imgLightbox').attr('src', $('#imagemAtual')[0].currentSrc);
    $('.imgLightbox').css({'display':'block'});
  });

  $('.close-lightbox').click(function(){
    $('.lightbox').fadeOut();
  });
});
