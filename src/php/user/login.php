<?php

  header('Content-type: application/json');
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['email']) && !empty($_POST['senha'])) {

    $email = trim(strip_tags(addslashes(filter_input(INPUT_POST, 'email'))));
    $senha = trim(strip_tags(addslashes(filter_input(INPUT_POST, 'senha'))));

    include_once "../autoload.php";
    $user = new UserController();

    $user->setEmail($email);
    $user->setSenha($senha);
    $result = $user->retornoLogin();

    if ($result) {
      session_start();
      $_SESSION['usuario'] = $result[0]['nome'];
      $_SESSION['email'] = $result[0]['email'];

      echo json_encode(['login' => true]);
    }
    else {
      echo json_encode(['login' => false]);
    }
  }
  else {
      echo json_encode(['login' => false]);
  }
?>
