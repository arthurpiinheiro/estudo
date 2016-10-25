<?php 
	include_once "Conexao.class.php";

	class Post extends Conexao{
		
		protected function bdListarPost(){
			$sql = "SELECT * FROM post";
			$select = $con->prepare($sql);
			$result = $select->execute();
			return $result->fetchAll();
		}
	}

 ?>