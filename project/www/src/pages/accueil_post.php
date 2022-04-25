<?php

  $folder_tmp = "tmp";
  if(defined("TMP_FOLDER")) {
    $folder_tmp = TMP_FOLDER;
  }


include_once dirname(__FILE__) . '/../class/Message.php';

$sgbd_message = new Message();

  $classmsg = "msg_valide";

  $message = "";
  $error_sgbd = "Une erreur s'est produite lors du téléchargement de la page, désolé pour ce désagrément.";

  $jton = md5(time());

  if(!empty($_POST) && array_key_exists('name', $_POST) && array_key_exists('first_name', $_POST) && 
    array_key_exists('mail', $_POST) && array_key_exists('user_text', $_POST)) {

    $valide = $sgbd_message->add_message($_POST['name'], $_POST['first_name'], $_POST['mail'], $_POST['user_text']);
    if($sgbd_message->error_number() == 0) {
      if(!$valide) {
        $classmsg = "msg_error";
      }
      $message = $sgbd_message->information();
    } else {
      $classmsg = "msg_error";
      $message = $error_sgbd;
    }

    $data_post = ['name' => $_POST['name'], 'first_name' => $_POST['first_name'], 'mail' => $_POST['mail'], 'user_text' => $_POST['user_text']];

    $message_display = [$classmsg, $message, $data_post];

    $json = json_encode($message_display);

    setcookie("info_message", $json, time()+900);

    header('Location: ./../../#section_contact');
    exit();
  }
 ?>