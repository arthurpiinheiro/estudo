<?php

namespace controller;

use model\User;

class UserController
{
    private $email;
    private $password;
    private $token;
    private $modelUser;

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }


    public function __construct()
    {
        $this->modelUser = new User();
    }

    private function login()
    {
        $response = array('message' => '', 'success' => false, 'data' => null);
        $data = array('email' => $this->getEmail(), 'password' => $this->getPassword(), 'token' => $this->getToken());
        $result = $this->modelUser->returnLoginDb($data);

        if ($result) {
            session_start();
            $_SESSION['currentUser'] = array(
                'cod' => $result[0]['cod'],
                'name' => $result[0]['name'],
                'email' => $this->getEmail(),
                'token' => $this->getToken()
            );

            $response['success'] = true;
            $response['message'] = 'Logado com sucesso!';
            $response['data'] = $_SESSION['currentUser'];
        }

        return $response;
    }

    public function returnLogin()
    {
        return $this->login();
    }

    private function logout()
    {
        $response = array('message' => '', 'success' => false);

        if (isset($_SESSION['currentUser'])) {
            session_unset();
            session_destroy();
            $response['success'] = true;
        }

        return $response;
    }

    public function returnLogout()
    {
        return $this->logout();

    }

    private function isLoggedIn()
    {
        session_start();
        $response = array('message' => '', 'success' => false);

        if (isset($_SESSION['currentUser']) && $_SESSION['currentUser']['token'] === $this->getToken()) {

            $response['success'] = !!$this->modelUser->returnIsLoggedInBd($this->getToken());

        } else {
            return $this->logout();
        }

        return $response;
    }

    public function returnIsLoggedIn()
    {
        return $this->isLoggedIn();
    }
}
