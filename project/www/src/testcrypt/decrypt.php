<?php

include_once './defpass.php';

function secured_decrypt($input)
{
$first_key = base64_decode(FIRSTKEY);
$second_key = base64_decode(SECONDKEY);           
$mix = base64_decode($input);
       
$method = "aes-256-cbc";   
$iv_length = openssl_cipher_iv_length($method);
           
$iv = substr($mix,0,$iv_length);
$second_encrypted = substr($mix,$iv_length,64);
$first_encrypted = substr($mix,$iv_length+64);
           
$data = openssl_decrypt($first_encrypted,$method,$first_key,OPENSSL_RAW_DATA,$iv);
$second_encrypted_new = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);
   
if (hash_equals($second_encrypted,$second_encrypted_new))
return $data;
   
return false;
}

echo secured_decrypt("DZSCMWUspAWIyqgjpqz2PuIxdoUMQc2R+Ab3MWzMugRCBKFpELyzzjYxJo+n75vR68tyHxPJInBLI4AqH3mY30Rfs60RpU24eX767F5Wt9tw/809r3JxdN5fYTQ4yXpz");

while ($msg = openssl_error_string())
    echo $msg . "<br />\n";

?>