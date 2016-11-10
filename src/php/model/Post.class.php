<?php
	include_once "Conexao.class.php";

	class Post extends Conexao{

     protected function bdListar(){
       $sql = "SELECT * FROM post";
       $insert = $this->prepare($sql);
       $insert->execute();
       return $insert->fetchAll();
     }

     protected function bdInserir($titulo, $descricao, $data, $codUsuario){
       $sql = "INSERT INTO `post`(`titulo`, `descricao`, `data`, `codUsuario`) VALUES ('".$titulo."','".$descricao."','".$data."','".$codUsuario."')";
       $insert = $this->prepare($sql);
       return $insert->execute();
     }
	}
 ?>
