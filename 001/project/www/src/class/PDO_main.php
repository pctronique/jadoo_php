<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!class_exists('PDO_main')) {

    /**
     * Description of PDO_connect
     *
     * @author pctronique
     * @version 1.1.0
     */
    class PDO_main extends PDO {
        
        /**
         * nom de la classe
         * @var string nom de la classe
         */
        private $the_class;

        /**
         * nom de la fonction
         * @var string nom de la fonction
         */
        private $function;

        /**
         * message d'erreur
         * @var string message d'erreur
         */
        private $error_text;
        
        /**
         * code erreur
         * @var int code erreur
         */
        private $error_number;
        
        /**
         * tableau d'erreur complet
         * @var array tableau d'erreur complet
         */
        private $error_results;

        //put your code here
        private $sgbd;
        private $server;
        private $database;
        private $username;
        private $passwd;
        private $port;
        private $prefix;

        /**
         * 
         * @param string|null $sgbd
         * @param string|null $server
         * @param string|null $database
         * @param string|null $username
         * @param string|null $passwd
         * @param string|null $port
         */
        public function __construct(?string $sgbd, ?string $server, ?string $database = null, 
                ?string $username = null, ?string $passwd = null, ?string $port = null) {
            $this->function = "__construct";
            $this->the_class = dirname(__FILE__) . '/' . get_class($this);
            $this->sgbd = ($sgbd === null) ? "" : $sgbd;
            $this->server = ($server === null) ? "" : $server;
            $this->database = ($database === null) ? "" : $database;
            $this->username = ($username === null) ? "" : $username;
            $this->passwd = ($passwd === null) ? "" : $passwd;
            $this->port = ($port === null) ? "" : $port;
            $this->prefix = "";
            $this->error_text = "";
            $this->error_number = 0;
        }
        
        /**
         * 
         * @param string|null $prefix
         * @return void
         */
        public function setPrefix(?string $prefix):void {
            $this->prefix = ($prefix === null) ? "" : $prefix;
        }
        
        /**
         * 
         * @return string|null
         */
        public function getPrefix():?string {
            return $this->prefix;
        }

        /**
         * Creation du tableau d'erreur
         * 
         * @return void
         */
        private function init_result(): void {
            $this->error_results = array(
                "class" => $this->the_class,
                "function" => $this->function,
                "error_text" => $this->error_text,
                "error_number" => $this->error_number,
                "sgbd" => $this->sgbd,
                "server" => $this->server,
                "database" => $this->database,
                "username" => $this->username,
                "passwd" => $this->passwd,
                "port" => $this->port
            );
        }
        
        /**
         * 
         * @param int $error_number
         * @param string|null $error
         * @return void
         */
        protected function addError(int $error_number, ?string $error): void {
            $this->error_text = $error;
            $this->error_number = $error_number;
        }
        
        /**
         * 
         * @param bool $isBase
         * @return string
         */
        private function lineConnect(bool $isBase = true): string {
            $line = $this->sgbd . ':host=' . $this->server;
            if(!empty($this->port) && $this->port !== "0") {
                $line .= ';port=' . $this->port;
            }
            if(!empty($this->database) && $isBase) {
                $line .= ';dbname=' . $this->database;
            }
            return $line.";charset=UTF8";
        }
        
        /**
         * 
         * @param bool $isBase
         * @return void
         */
        public function connect(bool $isBase = true): void {
            $this->function = "connect";
            $line = $this->lineConnect($isBase);
            try {
                if(!empty($this->username) && !empty($this->passwd)) {
                    parent::__construct($line, $this->username, $this->passwd);
                } else {
                    parent::__construct($line);
                }
                $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                if($this->errorCode() !== "00000") {
                    $this->error_text = "connection error ";
                    $this->error_number = 2801000001;
                }
            } catch (PDOException $e) {
                $this->error_text = $e;
                $this->error_number = 2801000002;
            }
        }
        
        /**
         * Message d'erreur
         * 
         * @return string|null Message d'erreur
         */
        public function error_text(): ?string {
            return $this->error_text;
        }

        /**
         * Code erreur
         * 
         * @return int Code erreur
         */
        public function error_number(): int {
            return $this->error_number;
        }

        /**
         * Tableau d'erreur
         * 
         * @return array|null Tableau d'erreur
         */
        public function error_results(): ?array {
            $this->init_result();
            return $this->error_results;
        }

    }

}
?>