<?php

if(!empty($_SESSION) && array_key_exists('id_user', $_SESSION) && array_key_exists('jeton', $_SESSION)) { ?>

<section id="admin">
</section>

<?php } else {
    header('Location: ./../../?pg=admin');
}

?>