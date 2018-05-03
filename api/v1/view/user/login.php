<?php

use controller\UserController;

header('Content-type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = trim(strip_tags(addslashes(filter_input(INPUT_POST, 'email'))));
    $password = md5(trim(strip_tags(addslashes(filter_input(INPUT_POST, 'password')))));
    $token = uniqid(md5(date('Y-m-d H:s:i"')));

    include_once "../../autoload.php";

    $user = new UserController();
    $user->setEmail($email);
    $user->setPassword($password);
    $user->setToken($token);
    echo json_encode($user->returnLogin());

} else {
    die("Access denied");
}
