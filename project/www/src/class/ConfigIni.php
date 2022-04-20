<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (!class_exists('ConfigIni')) {

    include_once dirname(__FILE__) . '/../config/config.php';

    /**
     * Description of ConfigIni
     *
     * @author pctronique
     */
    class ConfigIni {

        private $type;
        private $server;
        private $port;
        private $name;
        private $user;
        private $pass;
        private $prefix;
        private $error_code;
        private $error_message;
        
        /**
         * 
         */
        public function __construct() {
            $this->error_code = 0;
            $this->error_message = "";
            $this->valide = true;
            $file_config = RACINE_FOLDER_INI . "config.ini";
            if(!file_exists($file_config)) {
                $file_config = RACINE_FOLDER_INI . "config.ini.example";
                $this->valide = false;
            }
            if(!file_exists($file_config)) {
                $this->error_code = 4001000000;
                $this->error_message = "Le fichier de configuration n'a pas ete trouve.";
                $this->init = array();
            } else {
                $this->init = parse_ini_file($file_config, true);
                $this->type = $this->init["SGBD"]['type'];
                $this->server = $this->init["SGBD"]['server'];
                $this->port = $this->init["SGBD"]['port'];
                $this->name = $this->init["SGBD"]['name'];
                $this->user = $this->init["SGBD"]['user'];
                $this->pass = $this->init["SGBD"]['pass'];
                $this->prefix = $this->init["SGBD"]['prefix'];
            }
        }

        public function getError_code():int {
            return $this->error_code;
        }

        public function getError_message():?string {
            return $this->error_message;
        }
        
        public function getType():?string {
            return $this->type;
        }
        
        public function getServer():?string {
            return $this->server;
        }
        
        public function getPort():int {
            return $this->port;
        }
        
        public function getName():?string {
            return $this->name;
        }
        
        public function getUser():?string {
            return $this->user;
        }
        
        public function getPass():?string {
            return $this->pass;
        }
        
        public function getPrefix():?string {
            return $this->prefix;
        }
    }
}

?>
