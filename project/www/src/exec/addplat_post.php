<?php 
include_once dirname(__FILE__) . '/../class/User_Session.php';
include_once dirname(__FILE__) . '/../functions/main_function.php';
include_once dirname(__FILE__) . '/../functions/modifier_images.php';

$session_user = new User_Session();

if($session_user->isConnected()) {
    include_once dirname(__FILE__) . '/../class/SGBD_Plats.php';

    $sgbd_plats = new SGBD_Plats();

    
    if(!empty($_POST) && array_key_exists('id_plat', $_POST) && 
        array_key_exists('categorie', $_POST) && array_key_exists('name', $_POST) && 
        array_key_exists('description', $_POST)) {

        $name_img_plat = "";
        $message_display = ['error' => 0, 'msg' => "Enregistrement réussi."];
        if(!empty($_FILES) && !empty($_FILES["fileToUpload"]["name"])) {
            list($width, $height, $type) = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        
            if(type_valide($type)) {
                $name_img_plat = "img_tmp_".time().ext_type_image($type);
                modifier_image($_FILES["fileToUpload"]["tmp_name"], DATA_FOLDER_IMG."plat/", $name_img_plat, 320, 320);
                modifier_image($_FILES["fileToUpload"]["tmp_name"], DATA_FOLDER_IMG."maki/", $name_img_plat, 150, 150);
            }
        }
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
        setcookie("info_plat", $json, time()+900);
        header('Location: ./?pg=admin');
    }
} else {
    echo "Vous ne pouvez pas utiliser cette page.";
}

?>