<?php
	include_once "../model/Post.class.php";

	class PostController extends Post{
	   private $titulo;
     private $descricao;
     private $data;
     private $codUsuario;

     public function setTitulo($titulo){
       $this->titulo = $titulo;
     }

     private function getTitulo(){
       return $this->titulo;
     }

     public function setDescricao($descricao){
       $this->descricao = $descricao;
     }

     private function getDescricao(){
       return $this->descricao;
     }

     public function setData($data){
       $this->data = $data;
     }

     private function getData(){
       return $this->data;
     }

     public function setCodUsuario($codUsuario){
       $this->codUsuario = $codUsuario;
     }

     private function getCodUsuario(){
       return $this->codUsuario;
     }

     protected function publicacoes(){
       return $this->bdPublicacoes();
     }

     public function retornoPublicacao(){
       return $this->publicacoes();
     }
	}
 ?>
