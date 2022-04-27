<?php
if (!function_exists('string_number')) {

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