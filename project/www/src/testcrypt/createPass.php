<?php
// Create The First Key
echo base64_encode(openssl_random_pseudo_bytes(32));

// Create The Second Key
echo base64_encode(openssl_random_pseudo_bytes(64));
?>