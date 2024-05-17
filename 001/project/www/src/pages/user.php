<?php
// recuperation de la classe de session
include_once dirname(__FILE__) . '/../class/User_Session.php';

// ouvrir une section
$session_user = new User_Session();

// verifier qu'on est bien connecte
if($session_user->isConnected()) {

    // recuperation de la classe users connecte a la base de donnee
    include_once dirname(__FILE__) . '/../class/SGBD_Users.php';

    // creation de l'objet de l'utilisateur qui est connecte
    $sgbd_Users = new SGBD_Users();
    $id = 0;
    $name = "";
    $prenom = "";
    $login = "";
    $email = "";
    $user = $sgbd_Users->userId($_SESSION['id_user'], $_SESSION['jeton']);
    if(!empty($user)) {
        $name = $user->getName();
        $prenom = $user->getFirstname();
        $login = $user->getLogin();
        $email = $user->getEmail();
    }
    ?>

    <section id="admin">
        <form id="user" action="./?pg=modif_user" method="post">
            <label>Nom</label><input type="text" id="name" name="name" value="<?php echo $name ?>" />
            <label>Prénom</label><input type="text" id="firstname" name="firstname" value="<?php echo $prenom ?>" />
            <label>Login</label><input type="text" id="login" name="login" value="<?php echo $login ?>" />
            <label>email</label><input type="text" id="email" name="email" value="<?php echo $email ?>" />
            <button type="sumit" id="validate_user" class="button_bleu two_column_button">Valider</button>
        </form>
        <form id="pass" action="./?pg=modif_pass" method="post">
            <label>Ancien mot de passe</label><input type="password" id="pass_old" name="pass_old" autocomplete="on" />
            <label>Nouveau mot de passe</label><input type="password" id="pass_new_1" name="pass_new_1" autocomplete="on" />
            <label>Répéter le nouveau mot de passe</label><input type="password" id="pass_new_2" name="pass_new_2" autocomplete="on" />
            <button type="sumit" id="validate_pass" class="button_bleu two_column_button">Valider</button>
        </form>
    </section>

<?php } else {
    header('Location: ./../../?pg=admin');
}

?>