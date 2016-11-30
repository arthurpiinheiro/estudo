<?php
	include_once "../model/Post.class.php";

	class PostController extends Post{
	   private $titulo;
     private $descricao;
     private $data;
     private $codUsuario;
     private $codPost;
     private $imagem;

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

     public function setImagem($imagem){
       $this->imagem = $imagem;
     }

     private function getImagem(){
       return $this->imagem;
     }

     public function setCodPost($codPost){
       $this->codPost = $codPost;
     }

     private function getCodPost(){
       return $this->codPost;
     }

     protected function listarPublicacao(){
       return $this->bdListar();
     }

     public function retornoListarPublicacao(){
       return $this->listarPublicacao();
     }

     protected function inserirPublicacao(){
       return $this->bdInserir($this->getTitulo(), $this->getDescricao(), $this->getData(), $this->getCodUsuario(), $this->getImagem());
     }

     public function retornoInserirPublicacao(){
       return $this->inserirPublicacao();
     }

     protected function apagarPublicacao(){
       return $this->bdApagar($this->getCodPost());
     }

      public function retornoApagarPublicacao(){
        return $this->apagarPublicacao();
      }

      protected function listaPublicacao(){
        return $this->bdEditar($this->getCodPost());
      }

      public function retornoListaPublicacao(){
        return $this->listaPublicacao();
      }

      protected function atualizarPublicacao(){
        return $this->bdAtualizar($this->getTitulo(), $this->getDescricao(), $this->getData(), $this->getCodPost());
      }

      public function retornoAtualizarPublicacao(){
        return $this->atualizarPublicacao();
      }

			protected function atualizarImagem(){
				return $this->bdAtualizarImagem($this->getImagem(), $this->getCodPost());
			}

			public function retornoAtualizarImagem(){
				return $this->atualizarImagem();
			}
	}
 ?>
