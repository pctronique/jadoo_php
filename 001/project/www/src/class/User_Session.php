<?php

if (!class_exists('User_Session')) {
    
    // Initialiser la session
    session_start();

    include_once dirname(__FILE__) . '/SGBD_Users.php';
    

    class User_Session {

        public function __construct() {

        }

        public function start(?string $login, ?string $pass):bool {
            if (!empty($login) && !empty($pass)) {
                $users = new SGBD_Users();
                $user = $users->user($login, $pass);
                if(!empty($user)) {
                    $_SESSION['id_user'] = $user->getId();
                    $_SESSION['jeton'] = $user->getJeton();
                }
                return true;
            }
            return false;
        }

        public function stop():void {
            if(!empty($_SESSION) && array_key_exists('id_user', $_SESSION) && array_key_exists('jeton', $_SESSION)) {
                $_SESSION['id_user'] = "";
                $_SESSION['jeton'] = "";
                unset($_SESSION['id_user']);
                unset($_SESSION['jeton']);
                unset($_SESSION);
            }
            session_destroy();
        }

        public function isConnected(): bool {
            if(!empty($_SESSION) && array_key_exists('id_user', $_SESSION) && array_key_exists('jeton', $_SESSION)) {
                return true;
            }
            return false;
        }
    }
}
?>