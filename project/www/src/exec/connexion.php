<?php

include_once dirname(__FILE__) . '/../class/User_Session.php';

$session_user = new User_Session();

if (!empty($_POST) && array_key_exists("login", $_POST) && array_key_exists("password", $_POST)) {
    $session_user->start($_POST['login'], $_POST['password']);
}

header('Location: ./../../?pg=admin');

?>