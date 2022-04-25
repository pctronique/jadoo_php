<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!class_exists('Connect_SGBD')) {

    include_once dirname(__FILE__) . '/PDO_main.php';
    include_once dirname(__FILE__) . '/ConfigIni.php';

    /**
     * Description of Connect_SGBD
     *
     * @author pctronique
     * @version 1.1.0
     */
    class Connect_SGBD extends PDO_main {

        private $error_code;
        private $error_message;

        /**
         * 
         */
        public function __construct() {
            $this->error_code = 0;
            $this->error_message = "";
            $configIni = new ConfigIni();
            if($configIni->getError_code() == 0) {
                parent::__construct($configIni->getType(), $configIni->getServer(), 
                $configIni->getName(), $configIni->getUser(), 
                $configIni->getPass(), $configIni->getPort());
            } else {
                parent::addError($configIni->getError_code(), $configIni->getError_message());
            }
        }

    }

}

?>