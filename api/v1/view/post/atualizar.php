<?php
  header("Content-type: application/json");
  session_start();
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['codigo']) && isset($_SESSION['email'])){
    $codPost = trim(strip_tags(addslashes(filter_input(INPUT_POST, 'codPost'))));
    $titulo = trim(strip_tags(addslashes(filter_input(INPUT_POST, 'titulo'))));
    $descricao = trim(strip_tags(addslashes(filter_input(INPUT_POST, 'descricao'))));
    $data = date("Y-m-d H:s:i");
    $codUsuario = $_SESSION['codigo'];

    include_once "../autoload.php";
    $post = new PostController();
    $post->setTitulo($titulo);
    $post->setDescricao($descricao);
    $post->setData($data);
    $post->setCodPost($codPost);
    $resultPost = $post->retornoAtualizarPublicacao();

    if ($resultPost) {
      echo json_encode(['erro' => false, 'mensagem' => 'Post Atualizado com sucesso']);
    }
  }
  else{
    die("Acesso Negado.");
  }
?>
