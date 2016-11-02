<?php
	include_once "Conexao.class.php";

	class Post extends Conexao{

     protected function bdPublicacoes(){
       return true;
     }

     protected function bdInserir($titulo, $descricao, $data, $codUsuario){
       $sql = "INSERT INTO `post`(`titulo`, `descricao`, `data`, `codUsuario`) VALUES ('".$titulo."','".$descricao."','".$data."','".$codUsuario."')";
       $insert = $this->prepare($sql);
       return $insert->execute();
     }
	}
 ?>
