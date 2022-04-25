<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (!class_exists('Plat')) {

    include_once dirname(__FILE__) . '/User.php';

    /**
     * Description of ConfigIni
     *
     * @author pctronique
     */
    class Plat {

        private $nom;
        private $description;
        private $image;
        private $date;
        private $id;
        private $user;

        public function __construct(?string $nom, ?string $description, ?string $image) {
            $this->nom = $nom;
            $this->description = $description;
            $this->image = $image;
            $this->user = null;
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
         * Set the value of id
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
         * Get the value of nom
         */ 
        public function getNom():?string {
                return $this->nom;
        }

        /**
         * Get the value of description
         */ 
        public function getDescription():?string {
                return $this->description;
        }

        /**
         * Get the value of image
         */ 
        public function getImage():?string {
                return $this->image;
        }

        /**
         * Get the value of user
         */ 
        public function getUser():?User {
            return $this->user;
        }

        /**
         * Set the value of user
         */ 
        public function setUser(?User $user):void {
                $this->user = $user;
        }

    }
}

?>