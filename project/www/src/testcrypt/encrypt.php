<?php

include_once './defpass.php';

function secured_encrypt($data)
{
    $first_key = base64_decode(FIRSTKEY);
    $second_key = base64_decode(SECONDKEY);   
    
    $method = "aes-256-cbc";   
    $iv_length = openssl_cipher_iv_length($method);
    $iv = openssl_random_pseudo_bytes($iv_length);
        
    $first_encrypted = openssl_encrypt($data,$method,$first_key, OPENSSL_RAW_DATA ,$iv);   
    $second_encrypted = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);
            
    $output = base64_encode($iv.$second_encrypted.$first_encrypted);   
    return $output;       
}

echo secured_encrypt("test01");

while ($msg = openssl_error_string())
    echo $msg . "<br />\n";

?>