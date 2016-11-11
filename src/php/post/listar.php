<?php
  header("Content-type: application/json");
  session_start();
  if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['codigo']) && isset($_SESSION['email'])){

    include_once "../autoload.php";
    $post = new PostController();
    $result = $post->retornoListarPublicacao();

    if ($result) {
      echo json_encode(['posts' => $result]);
    }
    else{
      echo json_encode(['posts' => false]);
    }
  }
  else{
    die("Acesso Negado");
  }
?>
