<?php

namespace controller;

use model\Post;

class PostController
{
    private $title;
    private $description;
    private $date;
    private $codUser;
    private $codPost;
    private $image;
    private $modelPost;
    private $token;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getCodUser()
    {
        return $this->codUser;
    }

    /**
     * @param mixed $codUser
     */
    public function setCodUser($codUser)
    {
        $this->codUser = $codUser;
    }

    /**
     * @return mixed
     */
    public function getCodPost()
    {
        return $this->codPost;
    }

    /**
     * @param mixed $codPost
     */
    public function setCodPost($codPost)
    {
        $this->codPost = $codPost;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
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
        $this->modelPost = new Post();
    }

    protected function listPost()
    {
        $response = array('message' => '', 'success' => false, 'data' => null);
        $result = $this->modelPost->returnListPostDb();

        if ($result) {
            $response['data'] = $result;
            $response['success'] = true;
        }

        return $response;
    }

    public function returnListPost()
    {
        return $this->listPost();
    }

    private function moveImage($image)
    {
        $response = array('message' => '', 'success' => false, 'data' => null);
        $dir = $_SERVER['DOCUMENT_ROOT'] . "/estudo/src/img/uploads/";
        $extension = explode('.', $image['name']);
        $extension = end($extension);
        $nameImage = md5(date("Y-m-d H:s:i") . $_SERVER['REMOTE_ADDR']) . "." . $extension;
        $size = $image['size'];
        $extensions = array('jpg', 'png', 'jpeg');
        $maxSize = 1024 * 1024 * 1.8;

        if ($image['size'] <= 0) {
            $response['message'] = 'Envie uma imagem.';
            $response['success'] = false;

        } elseif (!in_array($extension, $extensions)) {
            $response['message'] = 'Só é permitido imagens com as seguintes extensões: JPG, JPEG, PNG.';
            $response['success'] = false;

        } elseif ($size > $maxSize) {
            $response['message'] = 'Só é permitido imagens de até 2M';
            $response['success'] = false;

        } elseif (!move_uploaded_file($image['tmp_name'], $dir . $nameImage)) {
            $response['message'] = 'Erro no upload da imagem. Tente novamente.';
            $response['success'] = false;

        } else {
            $response['data'] = $nameImage;
            $response['success'] = true;
        }
        return $response;
    }

    private function insertPost()
    {
        session_start();
        $response = array('message' => '', 'success' => false);

        if ($_SESSION['currentUser']['token'] === $this->getToken()) {
            $this->setCodUser($_SESSION['currentUser']['cod']);
            $resultImage = $this->moveImage($this->getImage());

            if (!$resultImage['success']) {
                return $resultImage;
            }

            $data = array(
                'title' => $this->getTitle(),
                'description' => $this->getDescription(),
                'date' => $this->getDate(),
                'codUser' => $this->getCodUser(),
                'image' => $resultImage['data']
            );
            $result = $this->modelPost->returnInsertPostBd($data);

            if ($result['success']) {
                $response['message'] = 'Cadastrado com sucesso!';
                $response['success'] = true;
            } else {
                return $result;
            }
        }

        return $response;

    }

    public function returnInsertPost()
    {
        return $this->insertPost();
    }

    private function deletePost()
    {
        $response = array('message' => '', 'success' => false);
        $result = $this->modelPost->returnDeletePostBd($this->getCodPost());

        if ($result) {
            $response['message'] = 'Publicação deletada com sucesso!';
            $response['success'] = true;
        }

        return $response;
    }

    public function returnDeletePost()
    {
        return $this->deletePost();
    }

    protected function listaPublicacao()
    {
        return $this->bdEditar($this->getCodPost());
    }

    public function retornoListaPublicacao()
    {
        return $this->listaPublicacao();
    }

    protected function atualizarPublicacao()
    {
        return $this->bdAtualizar($this->getTitulo(), $this->getDescricao(), $this->getData(), $this->getCodPost());
    }

    public function retornoAtualizarPublicacao()
    {
        return $this->atualizarPublicacao();
    }

    protected function atualizarImagem()
    {
        return $this->bdAtualizarImagem($this->getImagem(), $this->getCodPost());
    }

    public function retornoAtualizarImagem()
    {
        return $this->atualizarImagem();
    }
}

