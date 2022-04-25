<?php

include_once dirname(__FILE__) . '/../class/SGBD_Users.php';

session_start();

if (!empty($_POST) && array_key_exists("login", $_POST) && array_key_exists("password", $_POST)) {
    $users = new SGBD_Users();
    $user = $users->user($_POST['login'], $_POST['password']);
    if(!empty($user)) {
        $_SESSION['id_user'] = $user->getId_user();
        $_SESSION['jeton'] = $user->getJeton();
    }
}

header('Location: ./../../?pg=admin');

?>