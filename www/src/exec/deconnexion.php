<?php
// recuperation de la classe de session
include_once dirname(__FILE__) . '/../class/User_Session.php';

// creation de l'objet de session
$session_user = new User_Session();
// fermer la connexion
$session_user->stop();

// revenir sur la page
header('location: ./../../');

?>