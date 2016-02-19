<?php

/**
 * Name         : String.php
 * Date         : Jan 2016
 * Version      : 
 * Author       : Stefan
 * Description  : Static class. Provides a collection of services to assit
 *              : String manipulation
 * Notes        :
 */
class String {

    /**
     * Perform the replacement of a certain text on a string 
     * using a Regex pattern
     * @param string $string The string to replace the text in
     * @param string $pattern The regex pattern to be used
     * @param string $replacement The text you want to replace on the 
     * oribinal string
     * @return string The string replaced
     */
    public static function replace($string, $pattern, $replacement) {
        return preg_replace("/$pattern/", $replacement, $string);
    }

    /**
     * Checks if the input string contains a certain text
     * @param string $string Input String
     * @param string $text The text to be checked
     * @return boolean <b>TRUE</b> on success<br>
     * <b>FALSE</b> on failure
     */
    public static function contains($string, $text) {
        return preg_match("/$text/", $string);
    }

    /**
     * Split the input string by a certain character delimiter 
     * @param string $string The input string you want to split
     * @param string $character The string delimiter
     * @return array Array of the decomposed string
     */
    public static function decompose($string, $character) {
        return explode($character, $string);
    }

}
