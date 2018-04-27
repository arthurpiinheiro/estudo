<?php

namespace model;

use model\Connection;

class Post
{
    private $modelConnection;

    public function __construct()
    {
        $this->modelConnection = new Connection();
    }

    private function listPostDb()
    {
        $sql = "SELECT * FROM `post` ORDER BY `post`.`cod` DESC";
        $stmp = $this->modelConnection->prepare($sql);
        $stmp->execute();
        return $stmp->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function returnListPostDb()
    {
        return $this->listPostDb();
    }

    protected function insertPostBd($data)
    {
        $response = array('message' => '', 'success' => false);

        $sql = "INSERT INTO `post`(`title`, `description`, `date`, `codUser`) VALUES (:title, :description, :date, :codUser)";
        $stmpPost = $this->modelConnection->prepare($sql);
        $stmpPost->bindValue(':title', $data['title']);
        $stmpPost->bindValue(':description', $data['description']);
        $stmpPost->bindValue(':date', $data['date']);
        $stmpPost->bindValue(':codUser', $data['codUser']);
        $resultPost = $stmpPost->execute();

        if ($resultPost) {
            $sqlImage = "INSERT INTO `images`(`name`, `codPost`) VALUES (:nameImage, :codPost)";
            $stmpImage = $this->modelConnection->prepare($sqlImage);
            $stmpImage->bindValue(':nameImage', $data['image']);
            $stmpImage->bindValue(':codPost', $this->modelConnection->lastInsertId());
            if ($stmpImage->execute()) {
                $response['message'] = 'Erro ao cadastrar imagem';
            } else {
                $response['success'] = true;
            }
        } else {
            $response['message'] = 'Erro ao cadastrar post';
        }

        return $response;
    }

    public function returnInsertPostBd($data)
    {
        return $this->insertPostBd($data);
    }

    private function deletePostBd($cod)
    {
        $sql = "DELETE FROM `post` WHERE `post`.`cod` = :cod";
        $stmp = $this->modelConnection->prepare($sql);
        $stmp->bindValue(':cod', $cod);
        return $stmp->execute();
    }

    public function returnDeletePostBd($cod)
    {
        return $this->deletePostBd($cod);
    }

    protected function bdEditar($cod)
    {
        $sql = "SELECT * FROM `post` LEFT JOIN imagem ON `imagem`.`codPost` = `post`.`cod` WHERE `post`.`cod` = " . $cod . "";
        $insert = $this->prepare($sql);
        $insert->execute();
        return $insert->fetchAll();
    }

    protected function bdAtualizar($titulo, $descricao, $data, $codigo)
    {
        $sqlPost = "UPDATE `post` SET `titulo` = '" . $titulo . "', `descricao` = '" . $descricao . "', `data` = '" . $data . "' WHERE  `post`.`cod` = '" . $codigo . "' ";
        $updatePost = $this->prepare($sqlPost);
        return $updatePost->execute();
    }

    protected function bdAtualizarImagem($imagem, $codigo)
    {
        $sqlImagem = "UPDATE `imagem` SET `nome`='" . $imagem . "' WHERE `imagem`.`codPost` = '" . $codigo . "'";
        $updatePost = $this->prepare($sqlPost);
        return $updatePost->execute();
    }
}

