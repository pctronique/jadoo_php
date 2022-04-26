<?php 
// Initialiser la session
session_start();

if(!empty($_SESSION) && array_key_exists('id_user', $_SESSION) && array_key_exists('jeton', $_SESSION)) {
    if(!empty($_GET) && array_key_exists('admin', $_GET)) {
        if(strtolower($_GET["admin"]) == "messages") {
            $admin_onglet = ["", "checked", "", ""];
        } else if(strtolower($_GET["admin"]) == "utilisateur") {
            $admin_onglet = ["", "", "checked", ""];
        } else if(strtolower($_GET["admin"]) == "admin") {
            include_once dirname(__FILE__) . '/admin.php';
        }
    } else {
        include_once dirname(__FILE__) . '/plats.php';
    }
} else {
    include_once dirname(__FILE__) . '/connexion.php';
}


?>
