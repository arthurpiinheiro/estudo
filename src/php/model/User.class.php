<?php
	include_once "Conexao.class.php";

	class User extends Conexao{
    protected function bdLogin($email, $senha){
			$sql = "SELECT * FROM usuario WHERE email='".$email."' AND senha='".$senha."' ";
			$select = $this->prepare($sql);
			$select->execute();
      $result = $select->fetchAll();
      return $result;
		}

    protected function bdSessao($codigo, $email){
			$sql = "SELECT * FROM usuario WHERE cod='".$codigo."' AND email='".$email."' ";
			$select = $this->prepare($sql);
			$select->execute();
      $result = $select->fetchAll();
      return $result;
		}
	}
 ?>
