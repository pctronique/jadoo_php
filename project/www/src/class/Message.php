<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (!class_exists('Message')) {

        include_once dirname(__FILE__) . '/Date_Id.php';

    /**
     * Description of ConfigIni
     *
     * @author pctronique
     */
    class Message extends Date_Id {
        private $Nom;
        private $Prenom;
        private $Email;
        private $Message;
        private $lu;

        public function __construct($Nom, $Prenom, $Email, $Message) {
                parent::__construct();
            $this->Nom = $Nom;
            $this->Prenom = $Prenom;
            $this->Email = $Email;
            $this->Message = $Message;
            $this->lu = false;
        }

                /**
                 * Get the value of lu
                 */ 
                public function getLu():bool {
                        return $this->lu;
                }

                /**
                 * Set the value of lu
                 */ 
                public function setLuSt(?string $lu) {
                    $this->lu = false;
                    if (is_numeric($lu)) {
                        $num = intval($lu);
                        if (is_int($num)) {
                            $this->setLuInt(intval($num));
                        }
                    }
                }

                /**
                 * Set the value of lu
                 */ 
                public function setLuInt(int $lu) {
                        $this->lu = ($lu == 1);
                }
        
                /**
                 * Set the value of lu
                 */ 
                public function setLu(bool $lu) {
                        $this->lu = $lu;
                }

                /**
                 * Get the value of Nom
                 */ 
                public function getNom():?string {
                        return $this->Nom;
                }
        
                /**
                 * Get the value of Prenom
                 */ 
                public function getPrenom():?string {
                        return $this->Prenom;
                }
        
                /**
                 * Get the value of Email
                 */ 
                public function getEmail():?string {
                        return $this->Email;
                }
        
                /**
                 * Get the value of Message
                 */ 
                public function getMessage():?string {
                        return $this->Message;
                }

        
    }
}

?>