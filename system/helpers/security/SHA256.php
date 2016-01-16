<?php

/**
 * Name         : SHA256.php
 * Date         : Jan 2016
 * Version      : 
 * Author       : Stefan
 * Description  : 
 * Notes        :
 */

require_once(dirname(__FILE__)."/IHash.php");

class SHA256 implements IHash {
    
    /**
     * Performs the hashing procedure of a value using sha256 hash
     * @param string $value The value to be hashed
     * @return string The hashed value
     */
    public function hashvalue($value) {
      return hash("sha256", $value) ;
    }
    
}
