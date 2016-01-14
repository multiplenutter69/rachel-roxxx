<?php

/**
 * Name         : HAVALL1160-4.php
 * Date         : Jan 2016
 * Version      : 
 * Author       : Stefan
 * Description  : 
 * Notes        :
 */
class HAVALL1160_4 implements IHash{

    /**
     * Performs the hashing procedure of a value using haval160,4 hash
     * @param string $value The value to be hashed
     * @return string The hashed value
     */
    public function hashvalue($value) {
      return hash("haval160,4", $value) ;
    }
}
