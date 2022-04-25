<?php 
// Initialiser la session
session_start();

if(!empty($_SESSION) && array_key_exists('id_user', $_SESSION) && array_key_exists('jeton', $_SESSION)) {
    include_once dirname(__FILE__) . '/admin.php';
} else {
    include_once dirname(__FILE__) . '/connexion.php';
}


?>
