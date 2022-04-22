<?php

if (!class_exists('SGBD_crypt')) {

    class SGBD_crypt {
        
        private $cipher_algo;
        private $first_key;
        private $second_key;

        public function __construct(?string $first_key, ?string $second_key) {
            $this->cipher_algo = "camellia-128-cbc";
            $this->first_key = $first_key;
            $this->second_key = $second_key;
        }

        public function encrypt(?string $chaine):?string {
            $method = $this->cipher_algo;   
            $iv_length = openssl_cipher_iv_length($method);
            while ($msg = openssl_error_string())
                echo "<br />0000 : ".$msg . "<br />\n";
            $iv = openssl_random_pseudo_bytes($iv_length);
            while ($msg = openssl_error_string())
                echo "<br />0001 : ".$msg . "<br />\n";
                
            $first_encrypted = openssl_encrypt($chaine,$method,$this->first_key, OPENSSL_RAW_DATA ,$iv);   
            $second_encrypted = hash_hmac('sha3-512', $first_encrypted, $this->second_key, TRUE);
                    
            $output = base64_encode($iv.$second_encrypted.$first_encrypted);   
            return $output;  
        }

        public function decrypt(?string $chaine):?string {
            $mix = base64_decode($chaine);
       
            $method = $this->cipher_algo;   
            $iv_length = openssl_cipher_iv_length($method);
                    
            $iv = substr($mix,0,$iv_length);
            $second_encrypted = substr($mix,$iv_length,64);
            $first_encrypted = substr($mix,$iv_length+64);
                    
            $data = openssl_decrypt($first_encrypted,$method,$this->first_key,OPENSSL_RAW_DATA,$iv);
            $second_encrypted_new = hash_hmac('sha3-512', $first_encrypted, $this->second_key, TRUE);
            
            if (hash_equals($second_encrypted,$second_encrypted_new))
                return $data;
            
            return false;
        }

    }
}

?>