<?php
  header("Content-type: application/json");
  if ($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_SESSION['codigo']) && !isset($_SESSION['email'])){

    include_once "../autoload.php";
    $post = new PostController();
    $result = $post->retornoPublicacao();

    if ($result) {
      echo json_encode(['retorno' => true]);
    }
    else{
      echo json_encode(['retorno' =>false]);
    }
  }
?>
