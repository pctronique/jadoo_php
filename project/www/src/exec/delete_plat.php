<?php 
include_once dirname(__FILE__) . '/../class/User_Session.php';
include_once dirname(__FILE__) . '/../functions/main_function.php';
include_once dirname(__FILE__) . '/../class/SGBD_Plats.php';

$session_user = new User_Session();

if($session_user->isConnected()) {
    if(!empty($_POST) && array_key_exists('id', $_POST)) {
        $sgbd_plats = new SGBD_Plats();
        if($sgbd_plats->supprimer(string_number($_POST['id']))) {
            echo "Le plat a été supprimé.";
        } else {
            echo "une erreur c'est produite lors de la suppression.";
        }
    } else {
        echo "Vous ne pouvez pas utiliser cette page.";
    }
} else {
    echo "Vous ne pouvez pas utiliser cette page.";
}
?>