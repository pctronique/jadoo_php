<?php

if (!class_exists('Plats')) {

    include_once dirname(__FILE__) . '/Connect_SGBD.php';
    include_once dirname(__FILE__) . '/Error_Log.php';

    class Plats {

        private $sgbd;
        private $error_log;
        private $error_text;
        private $error_number;

        public function __construct() {
            $this->error_text = "";
            $this->error_number = 0;
            $this->error_log = new Error_Log();
            $this->sgbd = new Connect_SGBD();
            $this->sgbd->connect();
            $this->error_text = $this->sgbd->error_text();
            $this->error_number = $this->sgbd->error_number();
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
        
        public function plats_chaud():?array {
            if($this->sgbd->error_number() == 0) {
                try {
                    $values = [];
                    $res = $this->sgbd->prepare("SELECT * FROM plats LEFT JOIN categories ON plats.Id_Categorie = categories.Id_Categorie".
                    " WHERE categorie='plats_chaud' ORDER BY id DESC LIMIT 3");
                    $res->execute();
                    $data = $res->fetchAll(PDO::FETCH_OBJ);
                    foreach ($data as $valueLine) {
                        $data_line = [];
                        foreach ($valueLine as $key => $value){
                            $data_line[$key] = $value;
                        }
                        array_push($values, $data_line);
                    }
                    return $values;
                } catch (PDOException $exc) {
                    $this->error_text = $exc;
                    $this->error_number = 956710000;
                    $this->error_log->addError(956710000, "plats_chaud", $exc);
                    return array();
                }
            } else {
                $this->error_text = $this->sgbd->error_text();
                $this->error_number = $this->sgbd->error_number();
                $this->error_log->addError($this->sgbd->error_number(), "plats_chaud", $this->sgbd->error_text());
                return array();
            }

        }
        
        public function makis():?array {
            if($this->sgbd->error_number() == 0) {
                try {
                    $values = [];
                    $res = $this->sgbd->prepare("SELECT * FROM plats LEFT JOIN categories1 ON plats.Id_Categorie = categories.Id_Categorie".
                    " WHERE categorie='makis' ORDER BY id DESC LIMIT 4");
                    $res->execute();
                    $data = $res->fetchAll(PDO::FETCH_OBJ);
                    foreach ($data as $valueLine) {
                        $data_line = [];
                        foreach ($valueLine as $key => $value){
                            $data_line[$key] = $value;
                        }
                        array_push($values, $data_line);
                    }
                    return $values;
                } catch (PDOException $exc) {
                    $this->error_text = $exc;
                    $this->error_number = 956710001;
                    $this->error_log->addError(956710001, "plats_chaud", $exc);
                    return array();
                }
            } else {
                $this->error_text = $this->sgbd->error_text();
                $this->error_number = $this->sgbd->error_number();
                $this->error_log->addError($this->sgbd->error_number(), "plats_chaud", $this->sgbd->error_text());
                return array();
            }

        }

    }
}

?>

