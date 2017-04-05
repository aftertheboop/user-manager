<?php
/**
 * Mobile Helper
 * 
 * Helper class for mobile numbers
 */

function human_to_db($number) {
    
    $number = preg_replace("/[^0-9]/", "", $number);
        
    $db_number = '27' . substr($number, -9);
    
    return $db_number;
    
}

function db_to_human($number, $mask = true) {
    
    $human_number = '0' . substr($number, -9);
    
    // Mask out the number to a friendlier readable format 
    // if $mask == true
    if($mask === true) {
        
        $masked_number = array(
            substr($human_number, 0, 3),
            substr($human_number, 3, 3),
            substr($human_number, 6, 4)
        );
        
        $human_number = join(' ', $masked_number);
        
    }
    
    
    return $human_number;
    
}