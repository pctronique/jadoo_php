<?php

include_once dirname(__FILE__) . '/../class/User_Session.php';

$session_user = new User_Session();
$session_user->stop();

header('location: ./../../');

?>