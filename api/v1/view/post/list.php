<?php

use controller\PostController;

header("Content-type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    include_once "../../autoload.php";

    $post = new PostController();
    echo json_encode($post->returnListPost());

} else {
    die("Access denied");
}
