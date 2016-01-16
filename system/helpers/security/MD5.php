<?php

/**
 * Name         : MD5Hash.php
 * Date         : Jan
 * Version      : 
 * Author       : Stefan
 * Description  : 
 * Notes        :
 */

require_once(dirname(__FILE__)."/IHash.php");

class MD5 implements IHash {
    
    /**
     * Performs the hashing procedure of a value using md5 hash
     * @param string $value The value to be hashed
     * @return string The hashed value
     */
    public function hashvalue($value) {
      return hash("md5", $value) ;
    }
    
}
