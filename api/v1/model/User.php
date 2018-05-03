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

        if ($stmp->execute()) {
            $result = $stmp->fetchAll(\PDO::FETCH_ASSOC);
            $sqlToken = 'UPDATE `users` SET `token` = :token WHERE `users`.`cod` = :id';
            $stmpToken = $this->connection->prepare($sqlToken);
            $stmpToken->bindValue(':id', $result[0]['cod']);
            $stmpToken->bindValue(':token', $data['token']);

            return $stmpToken->execute() ? $result : false;

        } else {
            return false;
        }

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
        return $token;
    }

    public function returnIsLoggedInBd($token)
    {
        return $this->isLoggedInBd($token);
    }

}

