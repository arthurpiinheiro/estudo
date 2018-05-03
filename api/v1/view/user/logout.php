<?php

use controller\UserController;

header('Content-type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include_once '../../autoload.php';

    $user = new UserController();
    echo json_encode($user->returnLogout());

} else {
    die("Access denied");
}
