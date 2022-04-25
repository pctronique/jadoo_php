<?php

if (!class_exists('User')) {
        
        include_once dirname(__FILE__) . '/Pass_Crypt.php';

        class User
        {

                private $id_user;
                private $jeton;
                private $name;
                private $firstname;
                private $email;
                private $login;
                private $pass;
                private $date;

                public function __construct(?string $name, ?string $firstname, ?string $email, ?string $login)
                {
                        $this->id_user = -1;
                        $this->jeton = "";
                        $this->name = $name;
                        $this->firstname = $firstname;
                        $this->email = $email;
                        $this->login = $login;
                        $this->pass = "";
                        $this->date = 0;
                }

                /**
                 * Get the value of id_user
                 */
                public function getId_user(): ?string
                {
                        return $this->id_user;
                }

                /**
                 * Set the value of id_user
                 */
                public function setId_user(int $id_user): void
                {
                        $this->id_user = $id_user;
                }

                /**
                 * Set the value of id_user
                 */
                public function setId_userSt(?string $id_user): void
                {
                        $this->id_user = -1;
                        if (is_numeric($id_user)) {
                                $num = intval($id_user);
                                if (is_int($num)) {
                                        $this->id_user = intval($num);
                                }
                        }
                }

                /**
                 * Get the value of jeton
                 */
                public function getJeton(): ?string
                {
                        return $this->jeton;
                }

                /**
                 * Set the value of jeton
                 */
                public function setJeton(?string $jeton)
                {
                        $this->jeton = $jeton;
                }

                /**
                 * Get the value of name
                 */
                public function getName(): ?string
                {
                        return $this->name;
                }

                /**
                 * Get the value of firstname
                 */
                public function getFirstname(): ?string
                {
                        return $this->firstname;
                }

                /**
                 * Get the value of email
                 */
                public function getEmail(): ?string
                {
                        return $this->email;
                }

                /**
                 * Get the value of login
                 */
                public function getLogin(): ?string
                {
                        return $this->login;
                }

                /**
                 * Set the value of pass
                 */
                public function setPass_hash(?string $pass_hash)
                {
                        $this->pass = $pass_hash;
                }

                /**
                 * Set the value of pass
                 */
                public function setPass(?string $pass)
                {
                        $this->pass = Pass_Crypt::password($pass);
                }

                /**
                 * Get the value of pass
                 */
                public function getPass(): ?string
                {
                        return $this->pass;
                }

                public function verifyPass(?string $pass): bool
                {
                        return Pass_Crypt::verify($pass, $this->pass);
                }

                /**
                 * Get the value of date
                 */
                public function getDate(): ?int
                {
                        return $this->date;
                }

                /**
                 * Set the value of date
                 *
                 * @return  self
                 */
                public function setDate(?DateTime $date)
                {
                        $this->date = $date->getTimestamp();
                }

                /**
                 * Set the value of date
                 *
                 * @return  self
                 */
                public function setDateSt(?string $date)
                {
                        $this->date = strtotime($date);
                }

                /**
                 * Set the value of date
                 *
                 * @return  self
                 */
                public function getDateSt(): ?string
                {
                        return date('Y-M-d h:i:s', $this->date);
                }
        }
}
