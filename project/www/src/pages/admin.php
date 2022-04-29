<?php
// recuperation de la classe de session
include_once dirname(__FILE__) . '/../class/User_Session.php';

// ouvrir une section
$session_user = new User_Session();

// verifier qu'on est bien connecte
if($session_user->isConnected()) {

    include_once dirname(__FILE__) . '/../class/SGBD_Messages.php';

    $sgbd_message = new SGBD_Messages();

    $admin_onglet = ["checked", "", "", ""];
    if(!empty($_GET) && array_key_exists('admin', $_GET)) {
        if(strtolower($_GET["admin"]) == "messages") {
            $admin_onglet = ["", "checked", "", ""];
        } else if(strtolower($_GET["admin"]) == "utilisateur") {
            $admin_onglet = ["", "", "checked", ""];
        } else if(strtolower($_GET["admin"]) == "admin") {
            $admin_onglet = ["", "", "", "checked"];
        }
    }

    $admin_msg = 0;
    if(!empty($_GET) && array_key_exists('msg', $_GET)) {
        $admin_msg = $_GET["msg"];
    }

    $list_msg = $sgbd_message->all_messages();

    foreach ($list_msg as $value) {
        if($admin_msg == $value->getId()) {
            $sgbd_message->lu($admin_msg);
            $list_msg = $sgbd_message->all_messages();
        }
    }

    ?>

    <section id="admin">
        <a href="./?pg=deconn"><img id="img_dec" src="./src/imgs/se-deconnecter.svg" alt=""></a>


    <figure id="form_addmin" class="tabbled">
            <input type="radio" name="group1" value="0" id="tab0" <?php echo $admin_onglet[0] ?>>
            <input type="radio" name="group1" value="1" id="tab1" <?php echo $admin_onglet[1] ?>>
            <input type="radio" name="group1" value="2" id="tab2" <?php echo $admin_onglet[2] ?>>
            <input type="radio" name="group1" value="3" id="tab3" <?php echo $admin_onglet[3] ?>>
            <ul>
            <li id="onglet_1">
                <label id="onglet_label_0" for="tab0" class="onglet_default">Plats</label>
            </li>
            <li id="onglet_2">
                <label id="onglet_label_1" for="tab1" class="onglet_default">Messages</label>
            </li>
            <li id="onglet_3">
                <label id="onglet_label_2" for="tab2" class="onglet_default">Utilisateur</label>
            </li>
            <li id="onglet_4">
                <label id="onglet_label_3" for="tab3" class="onglet_default">Admin</label>
            </li>
            </ul>
            <form id="form_1" class="form_active">
            </form>
            <form id="form_2" class="form_active">
                <div id="messages">
                    <div id="list_msg">
                        <?php 
                            foreach ($list_msg as $value) { ?>
                                <figure class="un_msg">
                                    <img id="delete_msg_<?php echo $value->getId(); ?>" class="img_delete" src="./src/imgs/icons8-supprimer-pour-toujours-90.svg" title="supprimer le message" alt="supprimer le message" />
                                    <a href="/?pg=admin&admin=Messages&msg=<?php echo $value->getId(); ?>">
                                        <article id="msg_<?php echo $value->getId(); ?>" class="msg <?php echo ($value->getLu()) ? 'msg_lu' : 'msg_no_lu' ?>">
                                            <?php echo "de : ".$value->getNom()." ".$value->getPrenom()." (".$value->getEmail().")"; ?><br />
                                            <img class="img_msg" src="./src/imgs/<?php echo ($value->getLu()) ? 'ouvrir-la-messagerie-texte-enveloppe-24.svg' : 'nouveau-message-48.svg' ?>" 
                                            alt="<?php echo ($value->getLu()) ? 'message lu' : 'message non lu' ?>" title="<?php echo ($value->getLu()) ? 'message lu' : 'message non lu' ?>" />
                                            <?php echo $value->getDateSt(); ?>
                                        </article>
                                    </a>
                                </figure>
                            <?php }
                        ?>
                    </div>
                    <div id="msg">
                        <?php 
                            
                            foreach ($list_msg as $value) {
                                if($admin_msg == $value->getId()) {
                                    $sgbd_message->lu($admin_msg);
                                ?>
                                    <article">
                                        <?php echo $value->getMessage(); ?>
                                    </article>
                            <?php }
                            }
                        ?>
                    </div>
                </div>
            </form>
            <form id="form_3" class="form_active">
                <figure id="user">
                    <label>Nom</label><input type="text" id="name" name="name" />
                    <label>Prénom</label><input type="text" id="firstname" name="firstname" />
                    <label>Login</label><input type="text" id="login" name="login" />
                    <label>email</label><input type="text" id="email" name="email" />
                    <button type="sumit" id="validate_user" class="button_orange two_column_button">Valider</button>
                </figure>
                <figure id="pass">
                    <label>Ancien mot de passe</label><input type="password" id="pass_old" name="pass_old" autocomplete="on" />
                    <label>Nouveau mot de passe</label><input type="password" id="pass_new_1" name="pass_new_1" autocomplete="on" />
                    <label>Répéter le nouveau mot de passe</label><input type="password" id="pass_new_2" name="pass_new_2" autocomplete="on" />
                    <button type="sumit" id="validate_pass" class="button_orange two_column_button">Valider</button>
                </figure>
            </form>
            <form id="form_4" class="form_active">
            </form>
        </figure>

    </section>

<?php } else {
    header('Location: ./../../?pg=admin');
}

?>