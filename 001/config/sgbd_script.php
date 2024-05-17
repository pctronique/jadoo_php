<?php

include_once './../src/class/ConfigIni.php';

$script = new ConfigIni();

echo $script->crypt("root")."<br />";
while ($msg = openssl_error_string())
    echo $msg . "<br />\n";

/*echo $script->crypt("secret")."<br />";
while ($msg = openssl_error_string())
    echo $msg . "<br />\n";*/

?>