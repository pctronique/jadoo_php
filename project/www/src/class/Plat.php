<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (!class_exists('Plat')) {

    include_once dirname(__FILE__) . '/User.php';
    include_once dirname(__FILE__) . '/Date_Id.php';

    /**
     * Description of ConfigIni
     *
     * @author pctronique
     */
    class Plat extends Date_Id {

        private $nom;
        private $description;
        private $image;
        private $user;
        private $idCategorie;

        public function __construct(?string $nom, ?string $description, ?string $image) {
                parent::__construct();
            $this->nom = $nom;
            $this->description = $description;
            $this->image = $image;
            $this->user = null;
            $this->idCategorie = 0;
        }

        /**
         * Get the value of id_user
         */
        public function getIdCategorie(): int {
                return $this->idCategorie;
        }

        /**
         * Set the value of id_user
         */
        public function setIdCategorie(int $id): void {
                $this->idCategorie = $id;
        }

        /**
         * Set the value of id_user
         */
        public function setIdCategorieSt(?string $id): void {
                $this->idCategorie = 0;
                if (is_numeric($id)) {
                        $num = intval($id);
                        if (is_int($num)) {
                                $this->idCategorie = intval($num);
                        }
                }
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