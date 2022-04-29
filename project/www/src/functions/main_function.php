<?php
// verifier qu'on n'a pas deja creer la fonction
if (!function_exists('string_number')) {

    // conversion d'un nombre string en integer
    function string_number($value) {
        if (is_numeric($value)) {
            $num = intval($value);
            if (is_int($num)) {
                return intval($num);
            }
        }
        return 0;
    }
    
}
?>