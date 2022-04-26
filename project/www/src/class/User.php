<?php

if (!class_exists('User')) {

        include_once dirname(__FILE__) . '/Pass_Crypt.php';
        include_once dirname(__FILE__) . '/Date_Id.php';

        class User extends Date_Id
        {

                private $jeton;
                private $name;
                private $firstname;
                private $email;
                private $login;
                private $pass;
                private $admin;

                public function __construct(?string $name, ?string $firstname, ?string $email, ?string $login)
                {
                        parent::__construct();
                        $this->jeton = "";
                        $this->name = $name;
                        $this->firstname = $firstname;
                        $this->email = $email;
                        $this->login = $login;
                        $this->pass = "";
                        $this->admin = false;
                }
                
                /**
                 * Get the value of admin
                 */ 
                public function getAdmin(): bool {
                        return $this->admin;
                }

                /**
                 * Set the value of admin
                 *
                 * @return  self
                 */ 
                public function setAdmin(bool $admin): void {
                        $this->admin = $admin;
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

        }
        
}
