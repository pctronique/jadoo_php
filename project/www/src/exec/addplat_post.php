<?php 
include_once dirname(__FILE__) . '/../class/User_Session.php';
include_once dirname(__FILE__) . '/../functions/main_function.php';
include_once dirname(__FILE__) . '/../functions/modifier_images.php';

$session_user = new User_Session();

if($session_user->isConnected()) {
    include_once dirname(__FILE__) . '/../class/SGBD_Plats.php';

    $sgbd_plats = new SGBD_Plats();
    var_dump($_FILES);
    echo "<br />";
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    var_dump($check);
    echo $_FILES["fileToUpload"]['name']."<br />";
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    /*
    if(!empty($_POST) && array_key_exists('id_plat', $_POST) && array_key_exists('fileToUpload', $_POST) && 
        array_key_exists('categorie', $_POST) && array_key_exists('name', $_POST) && 
        array_key_exists('description', $_POST)) {

        if($sgbd_plats->addPlat(string_number($_POST['id_plat']), 
                $_POST['name'], $_POST[''], 
                $description, $categorie, 
                string_number($id_user))) {
            echo "1";
        } else {
            echo $$sgbd_plats->information();
        }

    } else {
        echo "Vous ne pouvez pas utiliser cette page.";
    }*/
} else {
    echo "Vous ne pouvez pas utiliser cette page.";
}

?>