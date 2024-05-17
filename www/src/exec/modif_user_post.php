<?php 
include_once dirname(__FILE__) . '/../class/User_Session.php';

// ouvrir une section
$session_user = new User_Session();

// verifier qu'on est bien connecte
if($session_user->isConnected()) {

    include_once dirname(__FILE__) . '/../class/SGBD_Users.php';

    $sgbd_users = new SGBD_Users();
    
    // verifier qu'on est bien passe par un formulaire (ou transmit les informations par post)
    if(!empty($_POST) && array_key_exists('name', $_POST) && 
        array_key_exists('firstname', $_POST) && array_key_exists('login', $_POST) && 
        array_key_exists('email', $_POST)) {
        $name_img_plat = "";
        $message_display = ['error' => 0, 'msg' => "Enregistrement réussi."];
        if($sgbd_users->modifierUser($_SESSION['id_user'], $_SESSION['jeton'], 
            $_POST['name'], $_POST['firstname'], $_POST['login'], $_POST['email'])) {
            echo "1";
        } else {
            echo "Une erreur c'est produit lors de l'enregistrement du produit.";
            $message_display = ['error' => 1, 'msg' => "Une erreur c'est produit lors de l'enregistrement du produit."];
        }

        $json = json_encode($message_display);
        setcookie("info_user", $json, time()+900);
        header('Location: ./?pg=admin&admin=utilisateur');
    }

} else {
    echo "Vous ne pouvez pas utiliser cette page.";
}

?>