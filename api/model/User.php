<?php

namespace model;

use model\Connection;

class User
{
    private $connection;

    public function __construct()
    {
        $this->connection = new Connection();
    }

    private function bdLogin($data)
    {
        $sql = "SELECT * FROM `users` WHERE `email` = :email AND `password` =:password ";
        $stmp = $this->connection->prepare($sql);
        $stmp->bindValue(':email', $data['email']);
        $stmp->bindValue(':password', $data['password']);
        $stmp->execute();
        return $stmp->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function returnLoginDb($data)
    {
        return $this->bdLogin($data);
    }

    private function isLoggedInBd($token)
    {
        $sql = "SELECT * FROM `users` WHERE `token` = :token";
        $stmp = $this->connection->prepare($sql);
        $stmp->bindValue(':token', $token);
        $stmp->execute();
        return $stmp->rowCount();
    }

    public function returnIsLoggedInBd($token)
    {
        return $this->isLoggedInBd($token);
    }

}

