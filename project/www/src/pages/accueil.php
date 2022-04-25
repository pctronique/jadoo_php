<?php
include_once dirname(__FILE__) . '/../class/Plats.php';
include_once dirname(__FILE__) . '/../class/Message.php';

$folder_tmp = "tmp";
if(defined("TMP_FOLDER")) {
    $folder_tmp = TMP_FOLDER;
}

$classmsg = "msg_valide";

$message = "";
$error_sgbd = "Une erreur s'est produite lors du téléchargement de la page, désolé pour ce désagrément.";

$form_name = "";
$form_prenom = "";
$form_email = "";
$form_msg = "";

if(!empty($_COOKIE) && array_key_exists("info_message", $_COOKIE)) {
    $obj = json_decode($_COOKIE['info_message']);
    $classmsg = $obj[0];
    $message = $obj[1];
    if($classmsg == "msg_error") {
      $data_post = $obj[2];
      $form_name = $data_post->name;
      $form_prenom = $data_post->first_name;
      $form_email = $data_post->mail;
      $form_msg = $data_post->user_text;
    }
    setcookie("info_message", "", time()-3600);
}

$sgbd_plats = new Plats();

?>

    <!-- contient la presentation -->
    <section id="section_presentation">
      
      <noscript>
        <p id="no_javascript">Javascript est désactivé dans votre navigateur web. Certaines fonctionnalités ne fonctionneront pas correctement.</p>
      </noscript>
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
        $plats = $sgbd_plats->plats_chaud();
        if($sgbd_plats->error_number() == 0) {
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
                  src="data/images/<?php echo $plat['Image'] ?>"
                  alt="Image <?php echo $plat['Nom'] ?>"
                />
                <p class="plat_text">
                <?php echo $plat['Description'] ?>
                </p>
              </article>
            </figure>
            <?php
          }
        } else {
            echo "<p class=\"error_sgbd\">".$error_sgbd."</>";
        }
        ?>
      </div>

      <div id="makis">
      <?php
        $plats = $sgbd_plats->makis();
        if($sgbd_plats->error_number() == 0) {
        $i = 0;
        foreach ($plats as $plat) {
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
                src="data/images/<?php echo $plat['Image'] ?>"
                alt="Image <?php echo $plat['Nom'] ?>"
              />
              <p>
                <span class="maki_title"><?php echo $plat['Nom'] ?></span><br />

                <span class="maki_text"><?php echo $plat['Description'] ?></span>
              </p>
            </article>
          </figure>
          <?php
          }
        } else {
          echo "<p class=\"error_sgbd\">".$error_sgbd."</>";
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
        <form id="form_inform" action="./#section_contact" method="post">
          <p id="form_title">Formulaire de contact</p>
          <p class="<?php echo $classmsg; ?>"><?php echo $message ?></p>
          <p>
            Remplissez le formulaire ci-dessous<br />
            pour nous contacter
          </p>
          <div class="user_name">
            <label>Nom</label>
            <input type="text" id="name" name="name" pattern="[A-Za-z '-]{3,}" placeholder="Nom" value="<?php echo $form_name ?>" required />
          </div>
          <div class="user_name" id="name_2">
            <label>Prénom</label>
            <input
              type="text"
              id="first_name"
              name="first_name"
              placeholder="Prénom"
              pattern="[A-Za-z '-]{3,}"
              value="<?php echo $form_prenom ?>"
              required
            />
          </div>
          <label>Adresse e-mail</label>
          <input
            type="email"
            id="mail"
            name="mail"
            placeholder="monAdresseMail@gmail.com"
            pattern="[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)"
            value="<?php echo $form_email ?>"
            required
          />
          <label>Message</label>
          <textarea
            id="user_text"
            name="user_text"
            pattern=".{8,}"
            placeholder="Votre message/demande de réservation"
            required
          ><?php echo $form_msg ?></textarea>
            <div class="text_center">
                <button id="button_form" class="button_bleu" type="sumit">
                  <img
                    src="src/imgs/bouton_formulaire_coche.svg"
                    alt="image pour cocher le formulaire"
                  />&nbsp;&nbsp;Envoyer
                </button>
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