<?php 
include_once dirname(__FILE__) . '/../class/User_Session.php';

$session_user = new User_Session();

if($session_user->isConnected()) {

    include_once dirname(__FILE__) . '/../class/SGBD_Users.php';

    $sgbd_users = new SGBD_Users();
    
    if(!empty($_POST) && array_key_exists('name', $_POST) && 
        array_key_exists('firstname', $_POST) && array_key_exists('login', $_POST) && 
        array_key_exists('email', $_POST)) {

        $name_img_plat = "";
        $message_display = ['error' => 0, 'msg' => "Enregistrement réussi."];
        if($sgbd_plats->addPlat(string_number($_POST['id_plat']), 
                $_POST['name'], $name_img_plat, 
                $_POST['description'], $_POST['categorie'], 
                string_number($_SESSION['id_user']))) {
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