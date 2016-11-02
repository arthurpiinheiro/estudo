<?php
  header('Content-type: application/json');
  if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['session'] == 'logout') {
    session_start();
    session_unset();
    session_destroy();
    echo json_encode(['logout' => true]);
  }
  else{
    die("Acesso Negado");
  }
?>
