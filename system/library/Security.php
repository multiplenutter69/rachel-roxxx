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
require_once (LIBRARYPATH . DS . "security" . DS . "AES.php");

class Security {

    /**
     * Performs te sanitizing of a field using the filter options of PHP
     * @param string $field The field to be sanitized
     * @param integer $filter PHP filter option Eg: FILTER_SANITIZE_SPECIAL_CHARS
     * @return value The clean field
     */
    public static function cleanImput($field, $filter = FILTER_SANITIZE_SPECIAL_CHARS) {
        return trim(strip_tags(filter_var($field, $filter)));
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

        $result = "Unknown";

        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $result = filter_input(INPUT_SERVER, 'HTTP_X_FORWARDED_FOR');
        }

        if (isset($_SERVER['HTTP_VIA'])) {
            $result = filter_input(INPUT_SERVER, 'HTTP_VIA');
        }

        if (isset($_SERVER['REMOTE_ADDR'])) {
            $result = filter_input(INPUT_SERVER, 'REMOTE_ADDR');
        }

        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $result = filter_input(INPUT_SERVER, 'HTTP_CLIENT_IP');
        }

        return $result;
    }

    /**
     * Performs the hashing of a value using a hashing algorithm
     * @param string $value The value to be hashed
     * @param IHash $method The IHash object that represents the hash algorithm
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

        $captcha = LIBRARYPATH . DS . "security" . DS . "captcha" . $value . ".jpg";
        $image = imagecreatefromjpeg(LIBRARYPATH . DS . "security" . DS . "fondo_captcha_60_30.jpg");
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
        global $config;
        return AES::encryptValue($value, $config["aes_key"]);
    }

    /**
     * Performs the decryption of a value encripted by an AES schema
     * <br>The AES key is defined on the config
     * @param string $value Decrypted value
     */
    public static function decrypt($value) {
        global $config;
        return AES::decryptValue($value, $config["aes_key"]);
    }

}
