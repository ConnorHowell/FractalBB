<?php
class Encryption extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function encrypt($method, $string)
    {
        if ($method == 'md5') {
            return md5($string);
        }
        elseif ($method == 'WhirlPool') {
             return strtoupper(hash('whirlpool', $string));
        }
        elseif ($method == 'udb_hash') {
            $length=strlen($string); 
            $s1 = 1; 
            $s2 = 0; 
            for($n=0; $n<$length; $n++) 
            { 
               $s1 = ($s1 + ord($string[$n])) % 65521; 
               $s2 = ($s2 + $s1) % 65521; 
            } 
            return ($s2 << 16) + $s1; 
        }
    }
}