<?php
	include_once "../model/User.class.php";

	class UserController extends User{
    private $cod;
    private $email;
    private $senha;

    public function setCodigo($codigo){
      $this->codigo = $codigo;
    }
    private function getCodigo(){
      return $this->codigo;
    }

    public function setEmail($email){
      $this->email = $email;
    }
    private function getEmail(){
      return $this->email;
    }

    public function setSenha($senha){
      $this->senha = $senha;
    }
    private function getSenha(){
      return $this->senha;
    }

    protected function login(){
      return $this->bdLogin($this->getEmail(), $this->getSenha());
    }

    public function retornoLogin(){
      return $this->login();
    }

    protected function sessao(){
      return $this->bdSessao($this->getCodigo(), $this->getEmail());
    }

    public function retornoSessao(){
      return $this->sessao();
    }
	}
?>
