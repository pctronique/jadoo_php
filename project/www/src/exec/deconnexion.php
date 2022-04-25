<?php

session_start();
if(!empty($_SESSION) && array_key_exists('id_user', $_SESSION) && array_key_exists('jeton', $_SESSION)) {
    $_SESSION['id_user'] = "";
    $_SESSION['jeton'] = "";
    unset($_SESSION['id_user']);
    unset($_SESSION['jeton']);
    unset($_SESSION);
}
session_destroy();
header('location: ./../../');

?>