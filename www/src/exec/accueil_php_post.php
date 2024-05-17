<?php

// recuperation de la classe message connecte a la base de donnee.
include_once dirname(__FILE__) . '/../class/SGBD_Messages.php';

// creation de l'objet de la classe message connecte a la base de donnee.
$sgbd_message = new SGBD_Messages();

  // Choissir le type de classe pour afficher le texte
  $classmsg = "msg_valide";

  // le message qui sera affiche
  $message = "";

  // si une erreur se produit dans la base de donnee
  $error_sgbd = "Une erreur s'est produite lors du téléchargement de la page, désolé pour ce désagrément.";

  // creation d'un jeton pour le message (pas utilise)
  $jton = md5(time());

  // verifier qu'on est bien passe par un formulaire (ou transmit les informations par post)
  if(!empty($_POST) && array_key_exists('name', $_POST) && array_key_exists('first_name', $_POST) && 
    array_key_exists('mail', $_POST) && array_key_exists('user_text', $_POST)) {

    // envoyer le message dans la base et verifier que tout c'est bien passe
    $sgbd_message->add_message($_POST['name'], $_POST['first_name'], $_POST['mail'], $_POST['user_text']);
    // en cas d'erreur
    if($sgbd_message->error_number() == 0) {
      // demander d'afficher l'erreur obtenu
      $classmsg = "msg_error";
      $message = $sgbd_message->information();
    } else {
      // afficher une erreur de la base de donnee
      $classmsg = "msg_error";
      $message = $error_sgbd;
    }

    // creation d'une sauvegarde des donnees
    $data_post = ['name' => $_POST['name'], 'first_name' => $_POST['first_name'], 'mail' => $_POST['mail'], 'user_text' => $_POST['user_text']];

    // sauvegarder les donnees et le message
    $message_display = [$classmsg, $message, $data_post];

    // transcrire les donnees dans un format json texte
    $json = json_encode($message_display);

    // placer le tout dans un cookie
    setcookie("info_message", $json, time()+900);

    // revenir sur la page
    header('Location: ./#section_contact');
    exit();
  }
 ?>