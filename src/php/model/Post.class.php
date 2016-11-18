<?php
	include_once "Conexao.class.php";

	class Post extends Conexao{

     protected function bdListar(){
       $sql = "SELECT * FROM post order by cod asc";
       $insert = $this->prepare($sql);
       $insert->execute();
       return $insert->fetchAll();
     }

     protected function bdInserir($titulo, $descricao, $data, $codUsuario, $imagem){
       $sqlPost = "INSERT INTO `post`(`titulo`, `descricao`, `data`, `codUsuario`) VALUES ('".$titulo."','".$descricao."','".$data."','".$codUsuario."')";
       $insertPost = $this->prepare($sqlPost);
       $insertPost->execute();
       $codigo = $this->lastInsertId();

       $sqlImagem = "INSERT INTO `imagem`(`nome`, `codPost`) VALUES ('".$imagem."','".$codigo."')";
       $insertImagem = $this->prepare($sqlImagem);
       return $insertImagem->execute();
     }

     protected function bdApagar($cod){
       $sql = "DELETE FROM `post` WHERE `post`.`cod` = ".$cod."";
       $insert = $this->prepare($sql);
       return $insert->execute();
     }

     protected function bdEditar($cod){
       $sql = "SELECT * FROM `post` LEFT JOIN imagem ON `imagem`.`codPost` = `post`.`cod` WHERE `post`.`cod` = ".$cod."";
       $insert = $this->prepare($sql);
       $insert->execute();
       return $insert->fetchAll();
     }
	}
 ?>
