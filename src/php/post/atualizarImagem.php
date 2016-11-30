<?php
  header("Content-type: application/json");
  session_start();
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['codigo']) && isset($_SESSION['email'])){
    $codPost = trim(strip_tags(addslashes(filter_input(INPUT_POST, 'codPost'))));
    $imagem = $_FILES['imagem'];
    $dir = "./../../img/uploads/";
    $extensao = end(explode('.', $imagem['name']));
    $nomeImagem = md5(date("Y-m-d H:s:i").$_SERVER['REMOTE_ADDR']).".".$extensao;
    $tamanho = $imagem['size'];
    $extensoes = ['jpg', 'png', 'jpeg'];
    $tamanhoMaximo = 1024 * 1024 * 1.8;

    include_once "../autoload.php";
    $post = new PostController();

    if (!in_array($extensao, $extensoes)) {
      echo json_encode(['erro' => true, 'mensagem' => 'Só é permitido imagens com as seguintes extensões: JPG, JPEG, PNG.', 'outros' => $_FILES['imagem']]);
    }
    elseif($imagem['size'] > $tamanhoMaximo){
      echo json_encode(['erro' => true, 'mensagem' => 'Só é permitido imagens de até 2M']);
    }
    else{
      $post->setImagem($nomeImagem);
      $resultImagem = $post->retornoAtualizarImagem();

      if ($resultImagem) {
        if (move_uploaded_file($imagem['tmp_name'], $dir.$nomeImagem)){
          echo json_encode(['erro' => false, 'mensagem' => 'Imagem Atualizada com sucesso']);
        }
        else{
          echo json_encode(['erro' => true, 'mensagem' => 'Erro ao mover a imagem para o servidor.']);
        }
      }
      else {
        echo json_encode(['erro' => true, 'mensagem' => 'Erro ao Atualizar a imagem no Banco de dados.']);
      }
    }
  }
  else{
    die("Acesso Negado.");
  }
?>
