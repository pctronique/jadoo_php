<?php
include_once dirname(__FILE__) . '/../class/User_Session.php';
include_once dirname(__FILE__) . '/../functions/main_function.php';

$session_user = new User_Session();

if($session_user->isConnected()) {

    $id_plat = 0;
    if(!empty($_GET) && array_key_exists('plat', $_GET)) {
        $id_plat = string_number($_GET["plat"]);
    }

    include_once dirname(__FILE__) . '/../class/SGBD_Plats.php';
    include_once dirname(__FILE__) . '/../class/SGBD_Users.php';

    $sgbd_plats = new SGBD_Plats();
    $sgbd_users = new SGBD_Users();

    $find = "";
    if(!empty($_GET) && array_key_exists('find', $_GET)) {
        $find = $_GET['find'];
    }

    $all_cate = $sgbd_plats->all_categorie();
    $all_plats = $sgbd_plats->all_plats($find);
    $src_img = "./src/imgs/add_picture_235.svg";
    $name = "";
    $description = "";
    $categorie = 0;
    $classmsg = "msg_valide";

    if(!empty($id_plat)) {
        $one_plat = $sgbd_plats->one_plats($id_plat);
        if(!empty($one_plat)) {
            $src_img = "./data/images/plat/".$one_plat->getImage();
            $categorie = $one_plat->getIdCategorie();
            $name = $one_plat->getNom();
            $description = $one_plat->getDescription();
        } else {
            $id_plat = 0;
        }
    }

    $msg = "";
    $error = false;
    if(!empty($_COOKIE) && array_key_exists("info_plat", $_COOKIE)) {
        $obj = json_decode($_COOKIE['info_plat']);
        $msg = $obj->msg;
        $error = ($obj->error == 1);
        if($error) {
            $classmsg = "msg_error";
        }
        setcookie("info_plat", "", time()-3600);
    }


    ?>

    <section id="admin" class="section_plat">
        <form id="plat" action="./?pg=add_plat" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_plat" value="<?php echo $id_plat ?>" />
            <input type="File" name="fileToUpload" id="fileToUpload" accept="image/png, image/jpeg" />
            <img id="img-plat" alt="modifier l'image du plat" src="<?php echo $src_img ?>" />
            <label>Catégorie</label><select name="categorie" id="categorie">
              <option value="">-</option>
                <?php foreach($all_cate as $value) {
                    $select = "";
                    if(string_number($value['Id_Categorie']) == $categorie) {
                        $select = "selected";
                    } ?>
                    <option value="<?php echo $value['Id_Categorie']; ?>" <?php echo $select; ?>><?php echo str_replace("_", " ", $value['Categorie']); ?></option>
                <?php } ?>
            </select>
            <label>Nom</label><input type="text" id="name" name="name" value="<?php echo $name ?>" />
            <label>Description</label><textarea id="description" name="description"><?php echo $description ?></textarea>
            <figure id="bt_valide_annule" class="two_column_button">
                <button type="sumit" id="validate_plat" class="button_bleu bt_plat">Valider</button>
                <a href="./?pg=admin" id="annuler_plat" class="button_gris bt_plat">Annuler</a>
            </figure>
        </form>
        <div id="find_plat">
            <p class="<?php echo $classmsg; ?>"><?php echo $msg ?></p>
            <form id="edit_find" action="./?pg=find" method="post">
                <label>Rechercher</label>
                <input type="text" id="rechercher" name="rechercher" />
                <button type="sumit" id="bt_find" class="button_bleu bt_plat">Rechercher</button>
            </form>
            <table>
        <thead>
          <tr>
            <th class="delete"><img alt="suprimer le plat" title="suprimer le plat" src="./src/imgs/icons8-supprimer-pour-toujours-90_white.svg" /></th>
            <th class="edit"><img alt="modifier le plat" title="modifier le plat" src="./src/imgs/icons8-modifier_white.svg" /></th>
            <th>titre</th>
          </tr>
        </thead>
        <tbody id="tab_find">
            <?php foreach ($all_plats as $key => $value) { ?>
                <tr>
                    <td id="delete_<?php echo $value->getId(); ?>" class="delete bt_delete">
                        <a href="http://localhost/?pg=admin&del_plat=<?php echo $value->getId(); ?>">
                            <img alt="suprimer le plat" title="suprimer le plat" src="./src/imgs/icons8-supprimer-pour-toujours-90.svg" />
                        </a>
                    </td>
                    <td id="edit_<?php echo $value->getId(); ?>" class="edit bt_edit">
                        <a href="http://localhost/?pg=admin&plat=<?php echo $value->getId(); ?>">
                            <img alt="modifier le plat" title="modifier le plat" src="./src/imgs/icons8-modifier.svg" />
                        </a>
                    </td>
                    <td class="tab_plat"><?php echo $value->getNom(); ?></td>
                </tr>
            <?php } ?>
        </tbody>
      </table>
        </div>
    </section>
    <script src="./src/js/plats.js"></script>

<?php } else {
    header('Location: ./../../?pg=admin');
}

?>