<?php

/**
 * Name         : Security.php
 * Date         : Jan 2016
 * Version      : 
 * Author       : Stefan
 * Description  : Static Class. Provides a collection of services to assists
 *              : Security handling on a project
 * Notes        :
 */
require_once ("../config/Config.php");
require_once (dirname(__FILE__) . "/security/AES.php");

class Security {

    /**
     * Performs te sanitizing of a field using the filter options of PHP
     * @param string $field The field to be sanitized
     * @param integer $filter PHP filter option Eg: FILTER_SANITIZE_SPECIAL_CHARS
     * @return value The clean field
     */
    public static function cleanImput($field, $filter) {
        return trim(stripslashes(filter_var($field, $filter)));
    }

    /**
     * Generates a random alphanumeric code of a certain length
     * <br>Te code is generate using md5 hash function, so the maximum length
     * of the code must not be more than 127
     * @param integer $length Code length
     * @return string The generated code
     */
    public static function generateCode($length = 127) {
        $totalLength = $length > 127 ? 127 : $length;
        return substr(md5(microtime()), 0, $totalLength);
    }

    /**
     * Returns de IP loaded on the superglobal variable $_SERVER[]
     * <br>Method does not support proxy use
     * @return string The IP address of the conection
     */
    public static function getIP() {

        if (isset(filter_input(INPUT_SERVER, 'HTTP_X_FORWARDED_FOR'))) {
            $result = filter_input(INPUT_SERVER, 'HTTP_X_FORWARDED_FOR');
        } elseif (isset(filter_input(INPUT_SERVER, 'HTTP_VIA'))) {
            $result = filter_input(INPUT_SERVER, 'HTTP_VIA');
        } elseif (isset(filter_input(INPUT_SERVER, 'REMOTE_ADDR'))) {
            $result = filter_input(INPUT_SERVER, 'REMOTE_ADDR');
        } elseif (isset(filter_input(INPUT_SERVER, 'HTTP_CLIENT_IP'))) {
            $result = filter_input(INPUT_SERVER, 'HTTP_CLIENT_IP');
        } else {
            $result = "Unknown";
        }

        return $result;
    }

    /**
     * Performs the hashing of a value using a hashing algorithm
     * @param string $value The value to be hashed
     * @param object $method The object that represents the hash algorithm
     * <br>All hashing methods implements de IHash interface
     * @return string Generated hash
     */
    public static function generateHash($value, $method) {
        return $method->hashValue($value);
    }

    /**
     * Generates a captcha image from a value<br>
     * Captcha image is base64 encoded
     * @param string $value The value to be putted on the image
     * @return string Captcha image base64 enconded
     */
    public static function captcha($value) {

        $captcha = dirname(__FILE__) . "/security/captcha" . $value . ".jpg";
        $image = imagecreatefromjpeg(dirname(__FILE__) . "/security/fondo_captcha_60_30.jpg");
        $textColor = imagecolorallocate($image, 0, 0, 0);

        imagestring($image, 5, 5, 5, $value, $textColor);
        imagejpeg($image, $captcha);

        $type = pathinfo($captcha, PATHINFO_EXTENSION);
        $data = file_get_contents($captcha);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        imagedestroy($image);
        unlink($captcha);

        return $base64;
    }

    /**
     * Performs the encryption of a value using AES schema
     * <br>The AES key is defined on the config
     * @param string $value Encrypted value
     */
    public static function ecncrypt($value) {
        AES::encryptValue($value, Config::getConfig()->getAesKey());
    }

    /**
     * Performs the decryption of a value encripted by an AES schema
     * <br>The AES key is defined on the config
     * @param string $value Decrypted value
     */
    public static function decrypt($value) {
        AES::decryptValue($value, Config::getConfig()->getAesKey());
    }

}
