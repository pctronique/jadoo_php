<?php

if (!class_exists('Message')) {

    include_once dirname(__FILE__) . '/Connect_SGBD.php';
    include_once dirname(__FILE__) . '/Error_Log.php';

    class Message {

        private $sgbd;
        private $error_log;
        private $info;

        public function __construct() {
            $this->error_log = new Error_Log();
            $this->sgbd = new Connect_SGBD();
            $this->sgbd->connect();
        }

        public function information() {
            return $this->info;
        }
        
        public function add_message(?string $Nom, ?string $Prenom, ?string $Email, ?string $Message): bool {
            $regexEmailValide = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/";

            if(preg_match("/^[A-Za-z '-]+$/",$Prenom) && preg_match("/^[A-Za-z '-]+$/",$Nom) 
                && preg_match($regexEmailValide,$Email)) {
                $res = $this->sgbd->prepare("INSERT INTO messages(Nom, Prenom, Email, Message) VALUES ".
                "(:Nom,:Prenom,:Email,:Message)");
                $res->execute([
                    ":Nom" => trim(stripslashes(strip_tags($Nom))),
                    ":Prenom" => trim(stripslashes(strip_tags($Prenom))),
                    ":Email" => trim(stripslashes(strip_tags($Email))),
                    ":Message" => trim(stripslashes(strip_tags($Message))),
                ]);
                $this->info = "Le message a été transmis, nous vous répondrons dans les plus brefs délais.";
                return true;
            } else {
                if(preg_match("/^[A-Za-z '-]+$/",$Nom)) {
                    $this->info = "Le nom n'est pas valide.";
                } else if(preg_match("/^[A-Za-z '-]+$/",$Prenom)) {
                    $this->info = "Le prénom n'est pas valide.";
                } else if(preg_match($regexEmailValide, $Email)) {
                    $this->info = "L'email n'est pas valide.";
                } else {
                    $this->info = "Les données ne sont pas valide.";
                }
            }
        }
        
    }
}

?>