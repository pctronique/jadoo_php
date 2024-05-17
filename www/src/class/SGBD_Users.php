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

        public function modifPass(int $id, ?string $passOld, ?string $passNew):bool {
            if ($this->sgbd->error_number() == 0) {
                try {
                    $values = [];
                    $res = $this->sgbd->prepare("SELECT * FROM user user LEFT JOIN admin ON user.id_admin = admin.id_admin WHERE id_user=:id_user");
                    $res->execute(array(
                        ":id_user" => $id
                    ));
                    $data = $res->fetchAll(PDO::FETCH_OBJ);
                    foreach ($data as $valueLine) {
                        $data_line = [];
                        foreach ($valueLine as $key => $value) {
                            $data_line[$key] = $value;
                        }
                        if(Pass_Crypt::verify($passOld, $data_line['pass'])) {
                            $res = $this->sgbd->prepare("UPDATE user SET pass=:pass WHERE id_user=:id_user");
                            $res->execute(array(
                                ":pass" => Pass_Crypt::password($passNew),
                                ":id_user" => $id
                            ));
                        } else {
                            $this->error_text = "l'ancien mot de passe n'est pas valide.";
                            $this->error_number = 956710065;
                            $this->error_log->addError(956710065, "plats_chaud", "l'ancien mot de passe n'est pas valide.");
                        }
                    }
                } catch (PDOException $exc) {
                    $this->error_text = $exc;
                    $this->error_number = 956710000;
                    $this->error_log->addError(956710000, "plats_chaud", $exc);
                }
            } else {
                $this->error_text = $this->sgbd->error_text();
                $this->error_number = $this->sgbd->error_number();
                $this->error_log->addError($this->sgbd->error_number(), "plats_chaud", $this->sgbd->error_text());
            }
            return false;
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

        public function modifierUser(int $id, ?string $jeton, ?string $name, ?string $firstname, ?string $login, ?string $email):bool {
            if ($this->sgbd->error_number() == 0) {
                try {
                    $user = new User(
                        utf8_encode(htmlspecialchars(stripslashes(trim($name)))),
                        utf8_encode(htmlspecialchars(stripslashes(trim($firstname)))),
                        utf8_encode(htmlspecialchars(stripslashes(trim($email)))),
                        utf8_encode(htmlspecialchars(stripslashes(trim($login))))
                    );
                    $user->setIdSt($id);
                    $values = null;
                    $res = $this->sgbd->prepare("UPDATE user SET name=:name,firstname=:firstname,email=:email,login=:login WHERE jeton=:jeton AND id_user=:id_user");
                    if($res->execute(array(
                        ':name' => htmlspecialchars(stripslashes(trim($name))),
                        ':firstname' => htmlspecialchars(stripslashes(trim($firstname))),
                        ':email' => htmlspecialchars(stripslashes(trim($email))),
                        ':login' => htmlspecialchars(stripslashes(trim($login))),
                        ':jeton' => htmlspecialchars(stripslashes(trim($jeton))),
                        ':id_user' => $id))) {
                        $res = $this->sgbd->prepare("UPDATE user SET jeton=:jeton  WHERE id_user=:id_user");
                        $res->execute(array(
                        ':jeton' => htmlspecialchars(stripslashes(trim($jeton))),
                        ':id_user' => $id));
                    }
                    return true;
                } catch (PDOException $exc) {
                    $this->error_text = $exc;
                    $this->error_number = 956710000;
                    $this->error_log->addError(956710000, "plats_chaud", $exc);
                }
            } else {
                $this->error_text = $this->sgbd->error_text();
                $this->error_number = $this->sgbd->error_number();
                $this->error_log->addError($this->sgbd->error_number(), "plats_chaud", $this->sgbd->error_text());
            }
            return false;
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
