<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (!class_exists('ConfigIni')) {

    if(file_exists(dirname(__FILE__) . '/../config/config.php')) {
        include_once dirname(__FILE__) . '/../config/config.php';
    }
    include_once dirname(__FILE__) . '/Error_Log.php';
    include_once dirname(__FILE__) . '/SGBD_crypt.php';

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
        private $error_log;
        private $sgbd_crypt;
        
        /**
         * 
         */
        public function __construct() {
            $this->error_log = new Error_Log();
            $this->error_code = 0;
            $this->init = array();
            $this->error_message = "";
            $this->valide = true;
            $this->sgbd_crypt = new SGBD_crypt("Lk5Uz3slx3BrAghS1aaW5AYgWZRV0tIX5eI0yPchFz4=", "EZ44mFi3TlAey1b2w4Y7lVDuqO+SRxGXsa7nctnr/JmMrA2vN6EJhrvdVZbxaQs5jpSe34X3ejFK/o9+Y5c83w==");
            $file_config = "config.ini";
            if(defined("RACINE_FOLDER_INI")) {
                $file_config = RACINE_FOLDER_INI . "config.ini";
                if(!file_exists($file_config)) {
                    $file_config = RACINE_FOLDER_INI . "config.ini.example";
                    $this->valide = false;
                }
                if(!file_exists($file_config)) {
                    $this->error_code = 4001000000;
                    $this->error_message = "Le fichier de configuration n'a pas ete trouve.";
                    $this->error_log->addError($this->error_code, "plats_chaud", $this->error_message);
                } else {
                    $this->init = parse_ini_file($file_config, true);
                    $this->type = $this->init["SGBD"]['type'];
                    $this->server = $this->init["SGBD"]['server'];
                    $this->port = $this->init["SGBD"]['port'];
                    $this->name = $this->init["SGBD"]['name'];
                    $this->user = $this->sgbd_crypt->decrypt($this->init["SGBD"]['user']);
                    $this->pass = $this->sgbd_crypt->decrypt($this->init["SGBD"]['pass']);
                    $this->prefix = $this->init["SGBD"]['prefix'];
                }
            } else {
                $this->error_code = 4001000010;
                $this->error_message = "Imposible de trouver le fichier : config.php";
                $this->error_log->addError($this->error_code, "plats_chaud", $this->error_message);
            }
            
        }

        public function crypt(?string $chaine):?string {
            return $this->sgbd_crypt->encrypt($chaine);
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
