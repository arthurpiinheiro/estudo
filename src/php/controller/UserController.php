<?php
	include_once "../model/User.class.php";

	class UserController extends User{
    private $email;
    private $senha;

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
	}
?>
