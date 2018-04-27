<?php
  header("Content-type: application/json");
  session_start();
  if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && isset($_SESSION['codigo']) && isset($_SESSION['email'])){
    $codigo = $_GET['id'];
    include_once "../autoload.php";
    $post = new PostController();
    $post->setCodPost($codigo);
    $result = $post->retornoListaPublicacao();

    if ($result) {
      echo json_encode(['error' => false, 'post' => $result]);
    }
    else{
      echo json_encode(['error' => true, 'mensagem' => 'Não foi possivel excluir essa publicação.']);
    }
  }
  else{
    echo json_encode(['error' => true]);
  }
?>
