<?php
  header("Content-type: application/json");
  session_start();
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['codigo']) && isset($_SESSION['email'])){
    $codigo = trim(strip_tags(addslashes(filter_input(INPUT_POST, 'codigo'))));
    include_once "../autoload.php";
    $post = new PostController();
    $post->setCodPost($codigo);
    $result = $post->retornoApagarPublicacao();

    if ($result) {
      echo json_encode(['error' => false, 'mensagem' => 'Publicação excluida com sucesso.']);
    }
    else{
      echo json_encode(['error' => true, 'mensagem' => 'Não foi possivel excluir essa publicação.']);
    }
  }
  else{
    die("Acesso Negado");
  }
?>
