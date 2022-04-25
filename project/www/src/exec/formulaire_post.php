<?php 

include_once dirname(__FILE__) . '/../class/Message.php';

$sgbd_message = new Message();

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