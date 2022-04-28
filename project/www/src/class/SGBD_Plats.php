<?php

if (!class_exists('SGBD_Plats')) {

    include_once dirname(__FILE__) . '/Connect_SGBD.php';
    include_once dirname(__FILE__) . '/Error_Log.php';
    include_once dirname(__FILE__) . '/Error_Log.php';
    include_once dirname(__FILE__) . '/Plat.php';

    class SGBD_Plats {

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

        public function one_plats(int $id):?Plat {
            if($this->sgbd->error_number() == 0) {
                try {
                    $values = null;
                    $res = $this->sgbd->prepare("SELECT * FROM plats LEFT JOIN categories ON plats.Id_Categorie = categories.Id_Categorie".
                    " WHERE id=:id");
                    $res->bindParam(':id', $id);
                    $res->execute();
                    $data = $res->fetchAll(PDO::FETCH_OBJ);
                    foreach ($data as $valueLine) {
                        $data_line = [];
                        foreach ($valueLine as $key => $value){
                            $data_line[$key] = $value;
                        }
                        $plat = new Plat($data_line['Nom'], $data_line['Description'], $data_line['Image']);
                        $plat->setIdSt($data_line['id']);
                        $plat->setIdCategorieSt($data_line['Id_Categorie']);
                        $values = $plat;
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
        }

        public function all_plats(?string $find = null):?array {
            if($this->sgbd->error_number() == 0) {
                try {
                    $values = [];
                    $sql = "SELECT * FROM plats LEFT JOIN categories ON plats.Id_Categorie = categories.Id_Categorie ".
                    " ORDER BY id DESC";
                    $data = array();
                    if(!empty($find)) {
                        $sql = "SELECT * FROM plats LEFT JOIN categories ON plats.Id_Categorie = categories.Id_Categorie ".
                        " WHERE Nom LIKE :find OR Description LIKE :find ORDER BY id DESC";
                        $data = array(":find" => '%'.$find.'%');
                    }
                    $res = $this->sgbd->prepare($sql);
                    $res->execute($data);
                    $data = $res->fetchAll(PDO::FETCH_OBJ);
                    foreach ($data as $valueLine) {
                        $data_line = [];
                        foreach ($valueLine as $key => $value){
                            $data_line[$key] = $value;
                        }
                        $plat = new Plat($data_line['Nom'], $data_line['Description'], $data_line['Image']);
                        $plat->setIdSt($data_line['id']);
                        $plat->setIdCategorieSt($data_line['Id_Categorie']);
                        array_push($values, $plat);
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
                        $plat = new Plat($data_line['Nom'], $data_line['Description'], $data_line['Image']);
                        $plat->setIdSt($data_line['id']);
                        $plat->setIdCategorieSt($data_line['Id_Categorie']);
                        array_push($values, $plat);
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

        public function addPlat(int $id, ?string $name, ?string $image, ?string $description, int $categorie, int $id_user):bool {
            if($this->sgbd->error_number() == 0) {
                try {
                    $plat = new Plat($name, $image,$description);
                    $plat->setIdCategorie($categorie);
                    if($id == 0) {
                        $sql = "INSERT INTO plats(Nom, Description, Image, Id_Categorie) VALUES (:Nom,:Description,:Image,:Id_Categorie)";
                        $tab_data = array(
                            ':Nom' => htmlspecialchars(stripslashes(trim($name))),
                            ':Description' => htmlspecialchars(stripslashes(trim($description))),
                            ':Image' => htmlspecialchars(stripslashes(trim($image))),
                            ':Id_Categorie' => htmlspecialchars(stripslashes(trim($categorie)))
                        );
                        if(empty($image)) {
                            $sql = "INSERT INTO plats(Nom, Description, Id_Categorie) VALUES (:Nom,:Description,:Id_Categorie)";
                            $tab_data = array(
                                ':Nom' => htmlspecialchars(stripslashes(trim($name))),
                                ':Description' => htmlspecialchars(stripslashes(trim($description))),
                                ':Id_Categorie' => htmlspecialchars(stripslashes(trim($categorie)))
                            );
                        }
                        $res = $this->sgbd->prepare($sql);
                        $res->execute($tab_data);
                        $last_id = $this->sgbd->lastInsertId();
                        $plat->setIdSt($last_id);
                        $jeton = $plat->jeton();
                        $resUd = $this->sgbd->prepare("UPDATE plats SET jeton=:jeton WHERE id=:id");
                        $resUd->execute(array(
                            ':id' => $last_id,
                            ':jeton' => $jeton
                        ));
                        return true;
                    } else if($id > 0) {
                        $plat->setIdSt($id);
                        $jeton = $plat->jeton();
                        $sql = "UPDATE plats SET Nom=:name,Description=:Description,Image=:Image,Id_Categorie=:Id_Categorie,jeton=:jeton WHERE id=:id";
                        $tab_data = array(
                            ':name' => htmlspecialchars(stripslashes(trim($name))),
                            ':Description' => htmlspecialchars(stripslashes(trim($description))),
                            ':Image' => htmlspecialchars(stripslashes(trim($image))),
                            ':Id_Categorie' => htmlspecialchars(stripslashes(trim($categorie))),
                            ':id' => htmlspecialchars(stripslashes(trim($id))),
                            ':jeton' => htmlspecialchars(stripslashes(trim($jeton)))
                        );
                        if(empty($image)) {
                            $sql = "UPDATE plats SET Nom=:name,Description=:Description,Id_Categorie=:Id_Categorie,jeton=:jeton WHERE id=:id";
                            $tab_data = array(
                                ':name' => htmlspecialchars(stripslashes(trim($name))),
                                ':Description' => htmlspecialchars(stripslashes(trim($description))),
                                ':Id_Categorie' => htmlspecialchars(stripslashes(trim($categorie))),
                                ':id' => htmlspecialchars(stripslashes(trim($id))),
                                ':jeton' => htmlspecialchars(stripslashes(trim($jeton)))
                            );
                        }
                        $res = $this->sgbd->prepare($sql);
                        $res->execute($tab_data);
                        $res->execute();
                        return true;
                    }
                } catch (PDOException $exc) {
                    $this->error_text = $exc;
                    $this->error_number = 956710001;
                    $this->error_log->addError(956710001, "plats_chaud", $exc);
                }
            } else {
                $this->error_text = $this->sgbd->error_text();
                $this->error_number = $this->sgbd->error_number();
                $this->error_log->addError($this->sgbd->error_number(), "plats_chaud", $this->sgbd->error_text());
            }
            return false;
        }
        
        public function makis():?array {
            if($this->sgbd->error_number() == 0) {
                try {
                    $values = [];
                    $res = $this->sgbd->prepare("SELECT * FROM plats LEFT JOIN categories ON plats.Id_Categorie = categories.Id_Categorie".
                    " WHERE categorie='makis' ORDER BY id DESC LIMIT 4");
                    $res->execute();
                    $data = $res->fetchAll(PDO::FETCH_OBJ);
                    foreach ($data as $valueLine) {
                        $data_line = [];
                        foreach ($valueLine as $key => $value){
                            $data_line[$key] = $value;
                        }
                        $plat = new Plat($data_line['Nom'], $data_line['Description'], $data_line['Image']);
                        $plat->setIdSt($data_line['id']);
                        $plat->setIdCategorieSt($data_line['Id_Categorie']);
                        array_push($values, $plat);
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

        public function all_categorie():?array {
            if($this->sgbd->error_number() == 0) {
                try {
                    $values = [];
                    $res = $this->sgbd->prepare("SELECT * FROM  categories");
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

    }
}

?>

