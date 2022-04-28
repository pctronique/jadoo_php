<?php 
include_once dirname(__FILE__) . '/../class/User_Session.php';

$session_user = new User_Session();

if($session_user->isConnected()) {

    if(!empty($_POST) && array_key_exists('rechercher', $_POST)) {
        header('Location: ./?pg=admin&find='.$_POST['rechercher']);
    }
    //header('Location: ./?pg=admin');
} else {
    echo "Vous ne pouvez pas utiliser cette page.";
}

?>