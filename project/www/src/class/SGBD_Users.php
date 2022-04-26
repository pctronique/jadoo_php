<?php

if (!class_exists('SGBD_Users')) {

    include_once dirname(__FILE__) . '/Pass_Crypt.php';
    include_once dirname(__FILE__) . '/Connect_SGBD.php';
    include_once dirname(__FILE__) . '/Error_Log.php';
    include_once dirname(__FILE__) . '/User.php';

    class SGBD_Users {

        private $User;

        public function __construct() {
            $this->error_log = new Error_Log();
            $this->sgbd = new Connect_SGBD();
            $this->sgbd->connect();
        }

        private function testAdmin(?string $name): bool {
            if(!empty($name)) {
                return false;
            }
            return ($name == "admin");
        }

        public function all(): ?array {
            if ($this->sgbd->error_number() == 0) {
                try {
                    $values = [];
                    $res = $this->sgbd->prepare("SELECT * FROM user user LEFT JOIN admin ON user.id_admin = admin.id_admin");
                    $res->execute();
                    $data = $res->fetchAll(PDO::FETCH_OBJ);
                    foreach ($data as $valueLine) {
                        $data_line = [];
                        foreach ($valueLine as $key => $value) {
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
                        $user->setIdSt($data_line['id_user']);
                        $user->setDateSt($data_line['date']);
                        $user->setAdmin($this->testAdmin($data_line['name_admin']));
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

        public function user(?string $login, ?string $pass): ?User {
            if ($this->sgbd->error_number() == 0) {
                try {
                    $values = null;
                    $res = $this->sgbd->prepare("SELECT * FROM user  user LEFT JOIN admin ON user.id_admin = admin.id_admin".
                    " WHERE login=:login OR email=:login");
                    $res->bindParam(':login', $login);
                    $res->execute();
                    $data = $res->fetchAll(PDO::FETCH_OBJ);
                    foreach ($data as $valueLine) {
                        $data_line = [];
                        foreach ($valueLine as $key => $value) {
                            $data_line[$key] = $value;
                        }
                        if(Pass_Crypt::verify($pass, $data_line['pass'])) {
                            $user = new User(
                                utf8_encode($data_line['name']),
                                utf8_encode($data_line['firstname']),
                                utf8_encode($data_line['email']),
                                utf8_encode($data_line['login'])
                            );
                            $user->setPass_hash($data_line['pass']);
                            $user->setJeton($data_line['jeton']);
                            $user->setIdSt($data_line['id_user']);
                            $user->setDateSt($data_line['date']);
                            $user->setAdmin($this->testAdmin($data_line['name_admin']));
                            $values = $user;
                        }
                    }
                    return $values;
                } catch (PDOException $exc) {
                    $this->error_text = $exc;
                    $this->error_number = 956710000;
                    $this->error_log->addError(956710000, "plats_chaud", $exc);
                    return null;
                }
            } else {
                $this->error_text = $this->sgbd->error_text();
                $this->error_number = $this->sgbd->error_number();
                $this->error_log->addError($this->sgbd->error_number(), "plats_chaud", $this->sgbd->error_text());
                return null;
            }
            return null;
        }

        public function userId(int $id, ?string $jeton): ?User {
            if ($this->sgbd->error_number() == 0) {
                try {
                    $values = null;
                    $res = $this->sgbd->prepare("SELECT * FROM user LEFT JOIN admin ON user.id_admin = admin.id_admin".
                    " WHERE id_user=:id_user OR jeton=:jeton");
                    $res->bindParam(':id_user', $id);
                    $res->bindParam(':jeton', $jeton);
                    $res->execute();
                    $data = $res->fetchAll(PDO::FETCH_OBJ);
                    foreach ($data as $valueLine) {
                        $data_line = [];
                        foreach ($valueLine as $key => $value) {
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
                            $user->setIdSt($data_line['id_user']);
                            $user->setDateSt($data_line['date']);
                            $user->setAdmin($this->testAdmin($data_line['name_admin']));
                            $values = $user;
                    }
                    return $values;
                } catch (PDOException $exc) {
                    $this->error_text = $exc;
                    $this->error_number = 956710000;
                    $this->error_log->addError(956710000, "plats_chaud", $exc);
                    return null;
                }
            } else {
                $this->error_text = $this->sgbd->error_text();
                $this->error_number = $this->sgbd->error_number();
                $this->error_log->addError($this->sgbd->error_number(), "plats_chaud", $this->sgbd->error_text());
                return null;
            }
            return null;
        }
    }
}
