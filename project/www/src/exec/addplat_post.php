<?php 
// recuperation des classes
include_once dirname(__FILE__) . '/../class/User_Session.php';
include_once dirname(__FILE__) . '/../functions/main_function.php';
include_once dirname(__FILE__) . '/../functions/modifier_images.php';

// ouvrir une section
$session_user = new User_Session();

// verifier qu'on est bien connecte
if($session_user->isConnected()) {

    // recuperation de la classe plat connecte a la base de donnee
    include_once dirname(__FILE__) . '/../class/SGBD_Plats.php';

    // creation de l'objet de la classe de connection plat
    $sgbd_plats = new SGBD_Plats();

    // verifier qu'on est bien passe par un formulaire (ou transmit les informations par post)
    if(!empty($_POST) && array_key_exists('id_plat', $_POST) && 
        array_key_exists('categorie', $_POST) && array_key_exists('name', $_POST) && 
        array_key_exists('description', $_POST)) {

        // creation du nom de l'image vide
        $name_img_plat = "";
        // le message a afficher dans la prochaine fenetre
        $message_display = ['error' => 0, 'msg' => "Enregistrement réussi."];
        // verifier qu'on a bien envoye un fichier
        if(!empty($_FILES) && !empty($_FILES["fileToUpload"]["name"])) {
            // recuperation des information du fichier
            list($width, $height, $type) = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        
            // verifier le type du fichier qui doit etre une image
            if(type_valide($type)) {
                // creation du nom du fichier
                $name_img_plat = "img_tmp_".time().ext_type_image($type);
                // creation de l'image pour les plats
                modifier_image($_FILES["fileToUpload"]["tmp_name"], DATA_FOLDER_IMG."plat/", $name_img_plat, 320, 320);
                // creation de l'image pour les makis
                modifier_image($_FILES["fileToUpload"]["tmp_name"], DATA_FOLDER_IMG."maki/", $name_img_plat, 150, 150);
            }
        }
        // ajouter le plat
        if($sgbd_plats->addPlat(string_number($_POST['id_plat']), 
                $_POST['name'], $name_img_plat, 
                $_POST['description'], $_POST['categorie'], 
                string_number($_SESSION['id_user']))) {
            echo "1";
        } else {
            // en cas d'erreur
            echo "Une erreur c'est produit lors de l'enregistrement du produit.";
            $message_display = ['error' => 1, 'msg' => "Une erreur c'est produit lors de l'enregistrement du produit."];
        }
        // transcrire les donnees dans un format json texte
        $json = json_encode($message_display);
        // placer le tout dans un cookie
        setcookie("info_plat", $json, time()+900);
        // revenir sur la page
        header('Location: ./?pg=admin');
    }
} else {
    echo "Vous ne pouvez pas utiliser cette page.";
}

?>