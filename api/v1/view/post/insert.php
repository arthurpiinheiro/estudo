<?php

use controller\PostController;

header("Content-type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = trim(strip_tags(addslashes(filter_input(INPUT_POST, 'title'))));
    $description = trim(strip_tags(addslashes(filter_input(INPUT_POST, 'description'))));
    $token = trim(strip_tags(addslashes(filter_input(INPUT_POST, 'token'))));
    $date = date("Y-m-d H:s:i");

    include_once "../../autoload.php";
    $post = new PostController();
    $post->setTitle($title);
    $post->setDescription($description);
    $post->setDate($date);
    $post->setImage($_FILES['image']);
    $post->setToken($token);

    echo json_encode($post->returnInsertPost());

} else {
    die("Access denied");
}
