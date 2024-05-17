<?php

if (!class_exists('SGBD_Messages')) {

    include_once dirname(__FILE__) . '/Connect_SGBD.php';
    include_once dirname(__FILE__) . '/Error_Log.php';
    include_once dirname(__FILE__) . '/Message.php';

    class SGBD_Messages {

        private $sgbd;
        private $error_log;
        private $info;
        private $error_text;
        private $error_number;

        public function __construct() {
            $this->error_text = "";
            $this->error_number = 0;
            $this->error_log = new Error_Log();
            $this->sgbd = new Connect_SGBD();
            $this->sgbd->connect();
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

        public function information() {
            return $this->info;
        }

        public function all_messages():?array {
            if($this->sgbd->error_number() == 0) {
                try {
                    $values = [];
                    $res = $this->sgbd->prepare("SELECT * FROM messages ORDER BY id DESC");
                    $res->execute();
                    $data = $res->fetchAll(PDO::FETCH_OBJ);
                    foreach ($data as $valueLine) {
                        $data_line = [];
                        foreach ($valueLine as $key => $value){
                            if(strtolower(gettype($value)) == "string") {
                                $data_line[$key] = utf8_encode($value);
                            } else {
                                $data_line[$key] = $value;
                            }
                        }
                        $message = new Message($data_line['Nom'], $data_line['Prenom'], $data_line['Email'], $data_line['Message']);
                        $message->setIdSt($data_line['Id']);
                        $message->setLuSt($data_line['lu']);
                        $message->setDateSt($data_line['date']);
                        array_push($values, $message);
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

        public function lu(int $id_message):bool {
            if($this->sgbd->error_number() == 0) {
                try {
                    $res = $this->sgbd->prepare("UPDATE messages SET lu=1 WHERE Id=:id_message");
                    $res->bindParam(':id_message', $id_message);
                    $res->execute();
                    return true;
                } catch (PDOException $exc) {
                    $this->error_text = $exc;
                    $this->error_number = 956710000;
                    $this->error_log->addError(956710000, "plats_chaud", $exc);
                    return false;
                }
            } else {
                $this->error_text = $this->sgbd->error_text();
                $this->error_number = $this->sgbd->error_number();
                $this->error_log->addError($this->sgbd->error_number(), "plats_chaud", $this->sgbd->error_text());
                return false;
            }

        }
        
        public function add_message(?string $Nom, ?string $Prenom, ?string $Email, ?string $Message): bool {
            if($this->sgbd->error_number() == 0) {
                $regexEmailValide = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/";

                if(preg_match("/^[A-Za-z '-]{3,}$/",$Prenom) && preg_match("/^[A-Za-z '-]{3,}$/",$Nom) 
                    && preg_match($regexEmailValide,$Email) && preg_match("/^.{8,}$/",$Message)) {
                    try {
                        $res = $this->sgbd->prepare("INSERT INTO messages(Nom, Prenom, Email, Message) VALUES ".
                        "(:Nom,:Prenom,:Email,:Message)");
                        $res->execute([
                            ":Nom" => utf8_decode(htmlspecialchars(stripslashes(trim($Nom)))),
                            ":Prenom" => utf8_decode(htmlspecialchars(stripslashes(trim($Prenom)))),
                            ":Email" => utf8_decode(htmlspecialchars(stripslashes(trim($Email)))),
                            ":Message" => utf8_decode(htmlspecialchars(stripslashes(trim($Message)))),
                        ]);
                        $this->info = "Le message a été transmis, nous vous répondrons dans les plus brefs délais.";
                        return true;
                    } catch (PDOException $exc) {
                        $this->error_text = $exc;
                        $this->error_number = 956710000;
                        $this->error_log->addError(956710000, "plats_chaud", $exc);
                    }
                } else {
                    if(!preg_match("/^[A-Za-z '-]{3,}$/",$Nom)) {
                        $this->info = "Le nom n'est pas valide.";
                    } else if(!preg_match("/^[A-Za-z '-]{3,}$/",$Prenom)) {
                        $this->info = "Le prénom n'est pas valide.";
                    } else if(!preg_match($regexEmailValide, $Email)) {
                        $this->info = "L'email n'est pas valide.";
                    } else if(!preg_match("/^.{8,}$/",$Message)) {
                        $this->info = "Le message n'est pas valide.";
                    } else {
                        $this->info = "Les données ne sont pas valide.";
                    }
                }
            } else {
                $this->error_text = $this->sgbd->error_text();
                $this->error_number = $this->sgbd->error_number();
                $this->error_log->addError($this->sgbd->error_number(), "plats_chaud", $this->sgbd->error_text());
            }
            return false;
        }
        
    }
}

?>