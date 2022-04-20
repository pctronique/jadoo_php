<?php
include_once 'src/class/Connect_SGBD.php';

$sgbd = new Connect_SGBD();
$sgbd->connect();

?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Jadoo : un voyage culinaire gourmet et gourmand</title>
    <link rel="icon" href="favicon.ico" />
    <link rel="stylesheet" href="src/css/fonts.css" />
    <link rel="stylesheet" href="src/css/animation.css" />
    <link rel="stylesheet" href="src/css/style.css" />
    <link rel="stylesheet" href="src/css/style_tablette_mobile.css" />
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
              <a href="#section_plat">Les nouveautés</a>
            </li>
            <li>
              <a href="#section_chef">Découvrir</a>
            </li>
            <li>
              <a href="#section_commande">Commander</a>
            </li>
            <li>
              <a href="#section_contact">Contactez-nous</a>
            </li>
          </ul>
        </nav>
      </div>
    </header>

    <!-- contient la presentation -->
    <section id="section_presentation">
      <p id="presentation_rapide">UN VOYAGE CULINAIRE GOURMET ET GOURMAND.</p>
      <h1 class="section_title">
        Bienvenue<br />
        au restaurant <span class="souligne-rouge">Jadoo</span>
      </h1>
      <p class="section_message">
        Jadoo vous accueille dans son ambiance zen et épurée, idéale pour
        découvrir ou redécouvrir la cuisine gastronomique du Chef Junichi IIDA.
      </p>
      <a class="button_text_decoration" href="#">
        <div
          id="button_presentation"
          class="button_orange"
          onclick="window.location.href='#';"
        >
          Découvrir la carte
        </div>
      </a>
    </section>

    <section id="section_plat">
      <div id="section_plat_decouvrir">Découvrez</div>
      <h2>Les nouveautés Jadoo</h2>
      <div id="plats">
        <?php
        $res = $sgbd->prepare("SELECT * FROM plats LEFT JOIN categories ON plats.Id_Categorie = categories.Id_Categorie".
        " WHERE categorie='plats_chaud' LIMIT 3");
        $res->execute();
        $plats = $res->fetchAll();
        $i = 0;
        foreach ($plats as $plat) {
          $i++;
          $image_filet = "plat_no_img_filet";
          if($i == 3) {
            $image_filet = "plat_img_filet";
          }
        ?>
        <figure class="<?php echo $image_filet ?>" id="plat_<?php echo $i ?>">
          <article class="plat">
            <h6>plat</h6>
            <img
              src="src/imgs/<?php echo $plat['Image'] ?>"
              alt="Image <?php echo utf8_encode($plat['Nom']) ?>"
            />
            <p class="plat_text">
            <?php echo utf8_encode($plat['Description']) ?>
            </p>
          </article>
        </figure>
        <?php
        }
        ?>
      </div>

      <div id="makis">
      <?php
        $res = $sgbd->prepare("SELECT * FROM plats LEFT JOIN categories ON plats.Id_Categorie = categories.Id_Categorie".
        " WHERE categorie='makis' LIMIT 4");
        $res->execute();
        $plats = $res->fetchAll();
        $i = 0;
        foreach ($plats as $plat) {
          $i++;
          $image_filet = "plat_no_img_filet";
          if($i == 3) {
            $image_filet = "plat_img_filet";
          }
        ?>
        <figure class="maki_figure">
          <img
            class="decoration_rose"
            src="src/imgs/decoration_rose.svg"
            alt="décoration d'une animation d'un carré rose"
          />
          <article class="maki">
            <h6>maki</h6>
            <img
              src="src/imgs/<?php echo $plat['Image'] ?>"
              alt="Image <?php echo utf8_encode($plat['Nom']) ?>"
            />
            <p>
              <span class="maki_title"><?php echo utf8_encode($plat['Nom']) ?></span><br />

              <span class="maki_text"><?php echo utf8_encode($plat['Description']) ?></span>
            </p>
          </article>
        </figure>
        <?php
        }
        ?>
      </div>
      <br />
      <a class="button_text_decoration" href="#">
        <div id="button_section_plat" class="button_orange">
          Découvrir la carte
        </div>
      </a>
    </section>

    <!-- contient la section chef -->
    <section id="section_chef">
      <video width="720" height="405" controls poster="src/imgs/visu_video.jpg">
        <source src="#" type="video/mp4" />
      </video>
      <div class="video">
        <img
          class="img_video"
          src="src/imgs/visu_video.jpg"
          alt="src/image de la vidéo"
        />
        <a href="#" class="button_video_play" title="lire la vidéo">
          <img
            class="button_video"
            src="src/imgs/button_play.svg"
            alt="image du bouton de lecture de la vidéo"
          />
        </a>
      </div>
      <h3 class="section_title">
        <span class="souligne-rouge">Un voyage</span> gastronomique entre le
        Japon et la France...
      </h3>
      <p class="section_message">
        Passé par des maisons étoilées en France, le cuisinier japonais s'est
        forgé une solide expérience dans l'Hexagone : aujourd'hui franc-comtois
        d'adoption, il maîtrise aujourd'hui les mélanges de cultures et de
        saveurs chaque jour au sein de son restaurant gastronomique.
      </p>
    </section>

    <!-- contient la section images -->
    <img
      id="img_chef"
      src="src/imgs/illustration_chef.jpg"
      alt="photo d'un chef de cuisine"
    />
    <div id="section_images">
      <img
        src="src/imgs/wrapper_illustration_1.jpg"
        alt="plat avec des baguettes chinoises"
      /><img
        id="section_image_right"
        src="src/imgs/wrapper_illustration_2.jpg"
        alt="illustration d'une pièce à manger chinoise"
      />
    </div>

    <!-- contient la section commande -->
    <section id="section_commande">
      <p class="section_commande_text_rapide">RAPIDE ET PRATIQUE</p>
      <br />
      <h4 class="section_commande_title">
        <span class="section_commande_text_orange">Commandez</span> sur le site
        Jadoo
      </h4>

      <div id="section_commande_articles">
        <article id="section_commande_first_article">
          <h6>livraison</h6>
          <img
            class="lien_livraison"
            src="src/imgs/logo_uberEats.png"
            alt="logo uberEats"
          />
          <p>
            <span class="section_commande_article_title">UberEats</span><br />

            Commandez tous vos plats depuis UberEats
          </p>
        </article>

        <article>
          <h6>livraison</h6>
          <img
            class="lien_livraison"
            src="src/imgs/logo_jadoo_1.svg"
            alt="logo jadoo"
          />
          <p>
            <span class="section_commande_article_title">Jadoo.fr</span><br />

            Ou commandez en ligne sur le site officiel de Jadoo
          </p>
        </article>

        <article>
          <h6>livraison</h6>
          <img
            class="lien_livraison"
            src="src/imgs/logo_transport.png"
            alt="logo transport"
          />
          <p>
            <span class="section_commande_article_title"
              >Livraison ultra rapide</span
            ><br />

            Soyez livré en 20 minutes maximum
          </p>
        </article>
      </div>
      <a class="button_text_decoration" href="#">
        <div id="button_section_commande" class="button_orange">
          Découvrir la carte
        </div>
      </a>
    </section>

    <!-- contient la section contact -->
    <section id="section_contact">
      <p id="section_contact_info">PRENDRE RENDEZ-VOUS</p>
      <br />
      <h5 id="section_contact_title">
        Contactez-nous <br />
        pour réserver au restaurant
      </h5>
      <br />
      <figure id="form_contact">
        <form>
          <p id="form_title">Formulaire de contact</p>
          <p>
            Remplissez le formulaire ci-dessous<br />
            pour nous contacter
          </p>
          <div class="user_name">
            <label>Nom</label>
            <input type="text" id="name" name="user_name" placeholder="Nom" />
          </div>
          <div class="user_name" id="name_2">
            <label>Prénom</label>
            <input
              type="text"
              id="first_name"
              name="user_first_name"
              placeholder="Prénom"
            />
          </div>
          <label>Adresse e-mail</label>
          <input
            type="email"
            id="mail"
            name="user_mail"
            placeholder="monAdresseMail@gmail.com"
          />
          <label>Message</label>
          <textarea
            id="user_text"
            name="user_text"
            placeholder="Votre message/demande de réservation"
          ></textarea>
          <div class="text_center">
              <div
                id="button_form"
                class="button_bleu"
              >
                <img
                  src="src/imgs/bouton_formulaire_coche.svg"
                  alt="image pour cocher le formulaire"
                />&nbsp;&nbsp;Envoyer
              </div>
          </div>
        </form>

        <div id="form_image">
          <img
            src="src/imgs/illustration_formulaire.jpg"
            alt="la photo d'un plat"
          />
        </div>
      </figure>
    </section>
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
            <li><a href="#">Nouveautés</a></li>
            <li><a href="#">Découvrir</a></li>
            <li><a href="#">Commander</a></li>
          </ul>

          <ul id="footer_title_right">
            <li class="title">Contact</li>
            <li><a href="#">Prendre</a></li>
            <li><a href="#">RDV</a></li>
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
      <p id="droits_reserves">Tous droits réservés @jadoo.com</p>
    </footer>
    <script src="./src/js/Post_Save.js"></script>
    <script src="./src/js/validation_formulaire.js"></script>
  </body>
</html>
