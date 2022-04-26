<?php 

include_once dirname(__FILE__) . '/../class/User_Session.php';

$session_user = new User_Session();

if($session_user->isConnected()) {
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
