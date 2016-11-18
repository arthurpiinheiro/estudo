<?php
  header("Content-type: application/json");
  session_start();
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['codigo']) && isset($_SESSION['email'])){
    $titulo = trim(strip_tags(addslashes(filter_input(INPUT_POST, 'titulo'))));
    $descricao = trim(strip_tags(addslashes(filter_input(INPUT_POST, 'descricao'))));
    $data = date("Y-m-d H:s:i");
    $codUsuario = $_SESSION['codigo'];

    $dir = "./../../img/uploads/";

    $imagem = $_FILES['imagem'];
    $extensao = end(explode('.', $imagem['name']));
    $nomeImagem = md5(date("Y-m-d H:s:i").$_SERVER['REMOTE_ADDR']).".".$extensao;
    $tamanho = $imagem['size'];

    $extensoes = ['jpg', 'png', 'jpeg'];
    $tamanhoMaximo = 1024 * 1024 * 1.8;

    if ($_FILES['imagem']['size'] <= 0) {
      echo json_encode(['erro' => true, 'mensagem' => 'Envie uma imagem']);
    }
    elseif (!in_array($extensao, $extensoes)) {
      echo json_encode(['erro' => true, 'mensagem' => 'Só é permitido imagens com as seguintes extensões: JPG, JPEG, PNG.']);
    }
    elseif($imagem['size'] > $tamanhoMaximo){
      echo json_encode(['erro' => true, 'mensagem' => 'Só é permitido imagens de até 2M']);
    }
    else{
      include_once "../autoload.php";
      $post = new PostController();
      $post->setTitulo($titulo);
      $post->setDescricao($descricao);
      $post->setData($data);
      $post->setCodUsuario($codUsuario);
      $post->setImagem($nomeImagem);
      $result = $post->retornoInserirPublicacao();

      if ($result) {
        if (move_uploaded_file($imagem['tmp_name'], $dir.$nomeImagem)){
          echo json_encode(['erro' => false, 'mensagem' => 'Post cadastrado com sucesso!!']);
        }
        else{
          echo json_encode(['erro' => true, 'mensagem' => 'Erro ao mover a imagem para o servidor.']);
        }
      }
      else {
        echo json_encode(['erro' => true, 'mensagem' => 'Erro ao cadastrar a imagem no Banco de dados.']);
      }
    }
  }
  else{
    die("Acesso Negado.");
  }
?>
