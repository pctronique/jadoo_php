<?php 
include_once dirname(__FILE__) . '/../class/User_Session.php';
include_once dirname(__FILE__) . '/../functions/main_function.php';
include_once dirname(__FILE__) . '/../functions/SGBD_Messages.php';

$session_user = new User_Session();

if($session_user->isConnected()) {
    if(!empty($_POST) && array_key_exists('id', $_POST)) {
        $sgbd_message = new SGBD_Messages();
        if($sgbd_message->supprimer(string_number($_POST['id']))) {
            echo "Le message a été supprimé.";
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