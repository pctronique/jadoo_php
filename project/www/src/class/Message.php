<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (!class_exists('Message')) {

    /**
     * Description of ConfigIni
     *
     * @author pctronique
     */
    class Message {

        private $id;
        private $date;
        private $Nom;
        private $Prenom;
        private $Email;
        private $Message;
        private $lu;

        public function __construct($Nom, $Prenom, $Email, $Message) {
            $this->Nom = $Nom;
            $this->Prenom = $Prenom;
            $this->Email = $Email;
            $this->Message = $Message;
        }

                /**
                 * Get the value of id_user
                 */
                public function getId(): int {
                        return $this->id;
                }

                /**
                 * Set the value of id_user
                 */
                public function setId(int $id): void {
                        $this->id = $id;
                }

                /**
                 * Set the value of id_user
                 */
                public function setIdSt(?string $id): void {
                        $this->id = 0;
                        if (is_numeric($id)) {
                                $num = intval($id);
                                if (is_int($num)) {
                                        $this->id = intval($num);
                                }
                        }
                }

                /**
                 * Get the value of date
                 */
                public function getDate(): ?int {
                        return $this->date;
                }

                /**
                 * Set the value of date
                 *
                 * @return  self
                 */
                public function setDate(?DateTime $date):void {
                        $this->date = $date->getTimestamp();
                }

                /**
                 * Set the value of date
                 *
                 * @return  self
                 */
                public function setDateSt(?string $date):void {
                        $this->date = strtotime($date);
                }

                /**
                 * Set the value of date
                 *
                 * @return  self
                 */
                public function getDateSt(): ?string {
                        return date('Y-M-d h:i:s', $this->date);
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