<?php

if (!class_exists('SGBD_crypt')) {

    include_once dirname(__FILE__) . '/Error_Log.php';
    class SGBD_crypt {
        
        private $first_method;
        private $second_methode;
        private $first_Key;
        private $second_key;
        private $error_log;
        private $error_text;
        private $error_number;

        public function __construct(?string $first_key, ?string $second_key) {
            $this->error_text = "";
            $this->error_number = 0;
            $this->error_log = new Error_Log();
            $this->first_method = "aes-256-cbc";
            $this->second_methode = 'sha3-512';
            $this->first_Key = $first_key;
            $this->second_key = $second_key;
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

        public function encrypt(?string $data):string {
            $first_key = base64_decode($this->first_Key);
            $second_key = base64_decode($this->second_key);   
            
            $method = $this->first_method;   
            $iv_length = openssl_cipher_iv_length($method);
            $iv = openssl_random_pseudo_bytes($iv_length);
                
            $first_encrypted = openssl_encrypt($data,$method,$first_key, OPENSSL_RAW_DATA ,$iv);   
            $second_encrypted = hash_hmac($this->second_methode, $first_encrypted, $second_key, TRUE);
                    
            $output = base64_encode($iv.$second_encrypted.$first_encrypted); 
            $all_error = "";
            while ($msg = openssl_error_string()) {
                $all_error = "error : ".$msg . "\n";
                echo "error : ".$msg . "<br />";
            }
            if(!empty($all_error)) {
                $this->error_text = $all_error;
                $this->error_number = 776710000;
                $this->error_log->addError(776710000, "plats_chaud", $all_error);
            }
            return $output;       
        }

        public function decrypt(?string $input):?string {
            $first_key = base64_decode($this->first_Key);
            $second_key = base64_decode($this->second_key);           
            $mix = base64_decode($input);
                
            $method = $this->first_method;   
            $iv_length = openssl_cipher_iv_length($method);
                    
            $iv = substr($mix,0,$iv_length);
            $second_encrypted = substr($mix,$iv_length,64);
            $first_encrypted = substr($mix,$iv_length+64);
                    
            $data = openssl_decrypt($first_encrypted,$method,$first_key,OPENSSL_RAW_DATA,$iv);
            $second_encrypted_new = hash_hmac($this->second_methode, $first_encrypted, $second_key, TRUE);
            
            if (hash_equals($second_encrypted,$second_encrypted_new)) {
                return $data; 
            }
            
            $all_error = "";
            while ($msg = openssl_error_string()) {
                $all_error = "error : ".$msg . "\n";
                echo "error : ".$msg . "<br />";

            }
            if(!empty($all_error)) {
                $this->error_text = $all_error;
                $this->error_number = 776710000;
                $this->error_log->addError(776710000, "plats_chaud", $all_error);
            }
            
            return "";
        }

    }
}

?>