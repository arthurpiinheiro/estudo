<?php

use controller\PostController;

header("Content-type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $cod = trim(strip_tags(addslashes(filter_input(INPUT_POST, 'cod'))));

    include_once "../../autoload.php";

    $post = new PostController();
    $post->setCodPost($cod);
    echo json_encode($post->returnDeletePost());

} else {
    die("Access denied");
}
