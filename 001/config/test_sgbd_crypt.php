<?php

include_once './../src/class/SGBD_crypt.php';

$sgbd_crypt = new SGBD_crypt("Lk5Uz3slx3BrAghS1aaW5AYgWZRV0tIX5eI0yPchFz4=", "EZ44mFi3TlAey1b2w4Y7lVDuqO+SRxGXsa7nctnr/JmMrA2vN6EJhrvdVZbxaQs5jpSe34X3ejFK/o9+Y5c83w==");

echo $sgbd_crypt->decrypt("001u9TheOxCkod00CZ5ZPjLQpedvbA0KOS2rDWzWGgBQS2X0DDMoNEX05xEDV7k1lVMdg7SI9g9z7WBE9c+lUFJq+r9WCfcjG3SWVs0WTgQ69M6q+JCoX9yjkHOjsn10xGP")."<br />";
while ($msg = openssl_error_string())
    echo $msg . "<br />\n";

echo $sgbd_crypt->decrypt("001oNgMWGBFoylvAhQsfL2eLWDcUPT7SMboiz4sH2tcMzPVXqiWy7GkyCDUVMrqs50TeId1xwJNikwJ0SdNhnvlcA==")."<br />";
while ($msg = openssl_error_string())
    echo $msg . "<br />\n";

?>