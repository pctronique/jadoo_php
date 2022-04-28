<?php
include_once dirname(__FILE__) . '/../class/User_Session.php';

$session_user = new User_Session();

if($session_user->isConnected()) {

    include_once dirname(__FILE__) . '/../class/SGBD_Messages.php';

    $sgbd_message = new SGBD_Messages();
    
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
        <div id="messages">
                    <div id="list_msg">
                        <?php 
                            foreach ($list_msg as $value) { ?>
                                <figure id="un_msg_<?php echo $value->getId(); ?>" class="un_msg">
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
    </section>

<?php } else {
    header('Location: ./../../?pg=admin');
}

?>