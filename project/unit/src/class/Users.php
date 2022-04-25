<?php

if (!class_exists('Users')) {

    include_once dirname(__FILE__) . '/Pass_Crypt.php';
    include_once dirname(__FILE__) . '/Connect_SGBD.php';
    include_once dirname(__FILE__) . '/Error_Log.php';
    include_once dirname(__FILE__) . '/User.php';

    class Users {

        private $User;

        public function __construct() {
            $this->error_log = new Error_Log();
            $this->sgbd = new Connect_SGBD();
            $this->sgbd->connect();
        }

        public function all():?array {
            if($this->sgbd->error_number() == 0) {
                try {
                    $values = [];
                    $res = $this->sgbd->prepare("SELECT * FROM user");
                    $res->execute();
                    $data = $res->fetchAll(PDO::FETCH_OBJ);
                    foreach ($data as $valueLine) {
                        $data_line = [];
                        foreach ($valueLine as $key => $value){
                            $data_line[$key] = $value;
                        }
                        $user = new User(
                            utf8_encode($data_line['name']),
                            utf8_encode($data_line['firstname']),
                            utf8_encode($data_line['email']),
                            utf8_encode($data_line['login'])
                        );
                        $user->setPass_hash($data_line['pass']);
                        $user->setJeton($data_line['jeton']);
                        $user->setId_userSt($data_line['id_user']);
                        $user->setDateSt($data_line['date']);
                        array_push($values, $user);
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


        /**
         * Get the value of User
         */ 
        public function getUser():?User {
                return $this->User;
        }

    }
}

?>