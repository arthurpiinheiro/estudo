<?php

use controller\UserController;

header('Content-type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $token = trim(strip_tags(addslashes(filter_input(INPUT_POST, 'token'))));

    include_once "../../autoload.php";

    $user = new UserController();
    $user->setToken($token);
    echo json_encode($user->returnIsLoggedIn());

} else {
    die('Access denied');
}

