<?php

if(!empty($_SESSION) && array_key_exists('id_user', $_SESSION) && array_key_exists('jeton', $_SESSION)) {

include_once dirname(__FILE__) . '/../class/Message.php';

$sgbd_message = new Message();

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

$admin_msg = -1;
if(!empty($_GET) && array_key_exists('msg', $_GET)) {
    $admin_msg = $_GET["msg"];
}

$list_msg = $sgbd_message->all_messages();

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
                            <a href="/?pg=admin&admin=Messages&msg=<?php echo $value['Id']; ?>"><article class="msg">
                                <?php echo "de : ".$value['Nom']." ".$value['Prenom']." (".$value['Email'].")"; ?><br />
                                <?php echo $value['lu']." ".$value['date']; ?>
                            </article></a>
                        <?php }
                    ?>
                </div>
                <div id="msg">
                    <?php 
                        
                        foreach ($list_msg as $value) {
                            if($admin_msg == $value['Id']) {
                             ?>
                                <article">
                                    <?php echo $value['Message']; ?>
                                </article>
                        <?php }
                        }
                    ?>
                </div>
            </div>
        </form>
        <form id="form_3" class="form_active">
            
        </form>
        <form id="form_4" class="form_active">
        </form>
      </figure>

</section>

<?php } else {
    header('Location: ./../../?pg=admin');
}

?>