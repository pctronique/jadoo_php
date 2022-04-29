<?php 
include_once dirname(__FILE__) . '/../class/User_Session.php';

$session_user = new User_Session();

if($session_user->isConnected()) {

    include_once dirname(__FILE__) . '/../class/SGBD_Users.php';

    $sgbd_users = new SGBD_Users();
    
    if(!empty($_POST) && array_key_exists('pass_old', $_POST) && 
        array_key_exists('pass_new_1', $_POST) && array_key_exists('pass_new_2', $_POST)) {
            $message_display = ['error' => 0, 'msg' => "Enregistrement réussi."];
            if($_POST["pass_new_1"] == $_POST["pass_new_2"]) {
                if(!$sgbd_users->modifPass($_SESSION['id_user'], $_POST['pass_old'], $_POST["pass_new_1"])) {
                    echo "Une erreur c'est produite lors du changement du mot de passe.";
                    $message_display = ['error' => 1, 'msg' => "Une erreur c'est produite lors du changement du mot de passe."];
                }
            } else {
                echo "Les mots de passe ne sont pas identique.";
                $message_display = ['error' => 1, 'msg' => "Les mots de passe ne sont pas identique."];
            }

        $json = json_encode($message_display);
        setcookie("info_user", $json, time()+900);
        header('Location: ./?pg=admin&admin=utilisateur');
    }

} else {
    echo "Vous ne pouvez pas utiliser cette page.";
}

?>