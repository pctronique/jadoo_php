<?php 
// recuperation des classes
include_once dirname(__FILE__) . '/../class/User_Session.php';
include_once dirname(__FILE__) . '/../functions/main_function.php';
include_once dirname(__FILE__) . '/../class/SGBD_Messages.php';

// ouvrir une section
$session_user = new User_Session();

// verifier qu'on est bien connecte
if($session_user->isConnected()) {
    // verifier qu'on est bien passe par un formulaire (ou transmit les informations par post)
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