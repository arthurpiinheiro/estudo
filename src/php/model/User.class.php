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
	}
 ?>
