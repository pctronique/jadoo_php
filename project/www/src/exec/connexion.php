<?php
// recuperation de la classe de session
include_once dirname(__FILE__) . '/../class/User_Session.php';

// creation de l'objet de session
$session_user = new User_Session();

// verifier qu'on a bien entree des informations de connexion
if (!empty($_POST) && array_key_exists("login", $_POST) && array_key_exists("password", $_POST)) {
    // si c'est bon, demarrer la connexion ou la refusser
    $session_user->start($_POST['login'], $_POST['password']);
}

// revenir sur la page
header('Location: ./../../?pg=admin');

?>