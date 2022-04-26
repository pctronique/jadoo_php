<?php
include_once dirname(__FILE__) . '/../class/User_Session.php';

$session_user = new User_Session();

if($session_user->isConnected()) {

    include_once dirname(__FILE__) . '/../class/SGBD_Plats.php';

    $sgbd_plats = new SGBD_Plats();
    $all_cate = $sgbd_plats->all_categorie();
    $name = "";
    $description = "";
    /*$user = $sgbd_Users->userId($_SESSION['id_user'], $_SESSION['jeton']);
    if(!empty($user)) {
        $name = $user->getName();
        $prenom = $user->getFirstname();
        $login = $user->getLogin();
        $email = $user->getEmail();
    }*/
    ?>

    <section id="admin">
        <form id="user">
            <input type="File" name="fileToUpload" id="fileToUpload" accept="image/png, image/jpeg" />
            <img id="img-plat" alt="modifier l'image du plat" src="./src/imgs/add_picture_235.svg" />
            <label>Catégorie</label><select name="categorie" id="categorie">
              <option value="">-</option>
              <?php foreach($all_cate as $value) { ?>
                <option value="<?php echo $value['Id_Categorie']; ?>"><?php echo str_replace("_", " ", $value['Categorie']); ?></option>
              <?php } ?>
            </select>
            <label>Nom</label><input type="text" id="name" name="name" value="<?php echo $name ?>" />
            <label>Description</label><textarea id="description" name="description"><?php echo $description ?></textarea>
            <figure id="bt_valide_annule" class="two_column_button">
                <button type="sumit" id="validate_plat" class="button_bleu bt_plat">Valider</button>
                <button type="sumit" id="annuler_plat" class="button_gris bt_plat">Annuler</button>
            </figure>
        </form>
    </section>
    <script src="./src/js/plats.js"></script>

<?php } else {
    header('Location: ./../../?pg=admin');
}

?>