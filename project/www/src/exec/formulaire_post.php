<?php 
// recuperation de la classe du message connecte avec la base de donnee
include_once dirname(__FILE__) . '/../class/SGBD_Messages.php';

// creation de l'objet du message connecte dans la basse de donnee
$sgbd_message = new SGBD_Messages();

// verifier qu'on est bien passe par un formulaire (ou transmit les informations par post)
if(!empty($_POST) && array_key_exists('name', $_POST) && array_key_exists('first_name', $_POST) && 
    array_key_exists('mail', $_POST) && array_key_exists('user_text', $_POST)) {

    if($sgbd_message->add_message($_POST['name'], $_POST['first_name'], $_POST['mail'], $_POST['user_text'])) {
        echo "1";
    } else {
        echo $sgbd_message->information();
    }

} else {
    echo "Vous ne pouvez pas utiliser cette page.";
}

?>