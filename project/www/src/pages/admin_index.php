<?php 
// recuperation de la classe de session
include_once dirname(__FILE__) . '/../class/User_Session.php';

// ouvrir une section
$session_user = new User_Session();

// verifier qu'on est bien connecte
if($session_user->isConnected()) {
    // choissir la page a afficher
    if(!empty($_GET) && array_key_exists('admin', $_GET)) {
        if(strtolower($_GET["admin"]) == "messages") {
            include_once dirname(__FILE__) . '/message.php';
        } else if(strtolower($_GET["admin"]) == "utilisateur") {
            include_once dirname(__FILE__) . '/user.php';
        } else if(strtolower($_GET["admin"]) == "admin") {
            include_once dirname(__FILE__) . '/admin.php';
        }
    } else {
        include_once dirname(__FILE__) . '/plats.php';
    }
} else {
    include_once dirname(__FILE__) . '/connexion.php';
}


?>
