<?php

include_once dirname(__FILE__) . '/src/class/User_Session.php';

$session_user = new User_Session();

$pg = "ind";
if(!empty($_GET) && array_key_exists("pg", $_GET)) {
  $pg = $_GET['pg'];
}

if($pg == "admin") {
} else if($pg == "delete_msg") {
  include_once dirname(__FILE__) . '/src/exec/delete_msg.php';
} else if($pg == "modif_pass") {
  include_once dirname(__FILE__) . '/src/exec/modif_pass_post.php';
} else if($pg == "modif_user") {
  include_once dirname(__FILE__) . '/src/exec/modif_user_post.php';
} else if($pg == "add_plat") {
  include_once dirname(__FILE__) . '/src/exec/addplat_post.php';
} else if($pg == "delete_plat") {
  include_once dirname(__FILE__) . '/src/exec/delete_plat.php';
} else if($pg == "find") {
  include_once dirname(__FILE__) . '/src/exec/recherche_plat_php_post.php';
} else if($pg == "conn") {
  include_once dirname(__FILE__) . '/src/exec/connexion.php';
} else if($pg == "deconn") {
  include_once dirname(__FILE__) . '/src/exec/deconnexion.php';
} else if($pg == "msgpost") {
  include_once dirname(__FILE__) . '/src/exec/formulaire_post.php';
} else {
  include_once dirname(__FILE__) . '/src/exec/accueil_php_post.php';
}

if($pg != "msgpost" && $pg != "conn" && $pg != "deconn" && $pg != "delete_msg" && 
    $pg != "add_plat" && $pg != "find" && $pg != "modif_user" && $pg != "modif_pass" && $pg != "delete_plat") {
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Jadoo : un voyage culinaire gourmet et gourmand</title>
    <link rel="icon" href="favicon.ico" />
    <link rel="stylesheet" href="src/css/fonts.css" />
    <link rel="stylesheet" href="src/css/animation.css" />
    <link rel="stylesheet" href="src/css/header_footer.css" />
    <link rel="stylesheet" href="src/css/header_footer_tablette_mobile.css" />
    <?php
    if($pg == "admin") { ?>
      <link rel="stylesheet" href="src/css/style_admin.css" />
      <link rel="stylesheet" href="src/css/tabbled.css" />
    <?php } else if($pg == "msgpost") {
    } else { ?>
        <link rel="stylesheet" href="src/css/style.css" />
        <link rel="stylesheet" href="src/css/style_tablette_mobile.css" />
    <?php } ?>
    <meta charset="utf8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=yes"
    />
  </head>

  <body>
    <!-- contient le menu de la page -->
    <header>
      <div id="head_logo">
        <img
          id="head_logo_01"
          src="src/imgs/logo_jadoo_1.svg"
          alt="logo maki de jadoo"
        />
        &nbsp;
        <img
          id="head_logo_02"
          src="src/imgs/logo_jadoo_2.svg"
          alt="logo du nom jadoo"
        />
      </div>
      <div id="menu_all">
        <img id="menu_mobile" src="src/imgs/burger_icon.svg" alt="bouton menu" />
        <nav>
          <ul id="head_right">
            <li>
              <a href="./#section_plat">Les nouveautés</a>
            </li>
            <li>
              <a href="./#section_chef">Découvrir</a>
            </li>
            <li>
              <a href="./#section_commande">Commander</a>
            </li>
            <li>
              <a href="./#section_contact">Contactez-nous</a>
            </li>
            <?php if($pg == "admin" && $session_user->isConnected()) { ?>
              <li id="submenu_categories">
              User
                <ul id="user_menu" class="submenu">
                  <li>
                    <a href="./?pg=admin">Plats</a>
                  </li>
                  <li>
                    <a href="./?pg=admin&admin=messages">Messages</a>
                  </li>
                  <li>
                    <a href="./?pg=admin&admin=utilisateur">Utilisateur</a>
                  </li>
                  <?php
                   /*
                  <!--<li>
                    <a href="./?pg=admin&admin=admin">Admin</a>
                  </li>
                  <li>
                    <a href="./?pg=admin">Logs</a>
                  </li>-->
                  */ ?>
                  <li>
                    <a href="./?pg=deconn">Déconnexion</a>
                  </li>
                </ul>
              <li>
            <?php } ?>
          </ul>
        </nav>
      </div>
    </header>

    <?php
    if($pg == "admin") {
      include_once dirname(__FILE__) . '/src/pages/admin_index.php';
    } else {
      include_once dirname(__FILE__) . '/src/pages/accueil.php';
    }
    ?>
    <!-- contient le pied de la page -->
    <footer>
      <div id="footer_contenu">
        <div class="block_footer" id="foot_jado">
          <img
            id="logo_foot_1"
            src="src/imgs/logo_jadoo_1.svg"
            alt="logo maki de jadoo"
          />&nbsp;&nbsp;
          <img
            id="logo_foot_2"
            src="src/imgs/logo_jadoo_2.svg"
            alt="logo du nom jadoo"
          /><br />
          <p id="logo_foot_text">
            Un voyage gastronomique entre le Japon et la France
          </p>
        </div>

        <div class="block_footer foot_center">
          <ul>
            <li class="title">Restaurant</li>
            <li><a href="./#section_plat">Nouveautés</a></li>
            <li><a href="./#section_chef">Découvrir</a></li>
            <li><a href="./#section_commande">Commander</a></li>
          </ul>

          <ul id="footer_title_right">
            <li class="title">Contact</li>
            <li><a href="./#section_contact">Prendre</a></li>
            <li><a href="./#section_contact">RDV</a></li>
          </ul>
        </div>

        <div class="block_footer">
          <img
            id="logo_uber_2"
            src="src/imgs/logo_uberEats_2.svg"
            alt="logo uberEats"
          />
          <br />Téléchargez UberEats<br /><br />

          <a class="button_text_decoration" href="#">
            <div class="button_back">
              <img
                class="image_center"
                src="src/imgs/logo_google_play.svg"
                alt="logo google play"
              />&nbsp;&nbsp;GOOGLE PLAY
            </div>
          </a>
          &nbsp;
          <a class="button_text_decoration" href="#">
            <div class="button_back">
              <img
                class="image_center"
                src="src/imgs/logo_apple.svg"
                alt="logo apple"
              />&nbsp;&nbsp;APPLE STORE
            </div>
          </a>
        </div>
      </div>
      <p id="droits_reserves">Tous droits réservés @<a href="./?pg=admin">jadoo.com</a></p>
    </footer>
    <?php
    if($pg == "admin") { ?>
      <script src="./src/js/Post_Save.js"></script>
      <script src="./src/js/message.js"></script>
    <?php } else {
      if($pg != "msgpost" && $pg != "conn" && $pg != "deconn" && $pg != "delete_msg") { ?>
        <script src="./src/js/Post_Save.js"></script>
        <script src="./src/js/validation_formulaire.js"></script>
      <?php }
    } ?>
  </body>
</html>
<?php } ?>