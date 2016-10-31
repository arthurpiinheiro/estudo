<?php
	include_once "Conexao.class.php";

	class User extends Conexao{

    // Login
    protected function bdLogin($email, $senha){
			$sql = "SELECT * FROM usuario WHERE email='".$email."' AND senha='".$senha."' ";
			$select = $this->prepare($sql);
			$select->execute();
      return $select->fetchAll();
		}

    // Sessao
    protected function bdSessao($codigo, $email){
			$sql = "SELECT * FROM usuario WHERE cod='".$codigo."' AND email='".$email."' ";
			$select = $this->prepare($sql);
			$select->execute();
      return $select->fetchAll();
		}
	}
 ?>
