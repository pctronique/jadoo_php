<?php

if(!empty($_SESSION) && array_key_exists('id_user', $_SESSION) && array_key_exists('jeton', $_SESSION)) { ?>

<section id="admin">
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
</section>

<?php } else {
    header('Location: ./../../?pg=admin');
}

?>