<?php
  header('Content-type: application/json');
  session_start();
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['codigo']) && isset($_SESSION['email'])){

    $codigo = $_SESSION['codigo'];
    $email = $_SESSION['email'];

    include_once "../autoload.php";

    $user = new UserController();
    $user->setCodigo($codigo);
    $user->setEmail($email);
    $result = $user->retornoSessao();

    if ($result) {
      echo json_encode(['session' => true]);
    }
    else{
      session_destroy();
      session_unset();
      echo json_encode(['session' => false]);
    }
  }
  else{
    session_destroy();
    session_unset();
    echo json_encode(['session' => false]);
  }

?>
