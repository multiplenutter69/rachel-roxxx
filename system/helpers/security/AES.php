<?php

/**
 * Name         : AES.php
 * Date         : Jan 2016
 * Version      : 1.0
 * Author       : Stefan
 * Description  : Static Class. Provides encrypton and decrypton functionality
 *              : using AES technology
 * Notes        :
 */
class AES {

    /**
     * Performs the encryption of a value using AES schema
     * @param string $value The value to be encrypted
     * @param string $AESKey The key that would be used to perform the encryption
     * @return string Encrypted value
     */
    public static function encrypt($value, $AESKey) {
        return rtrim(
                base64_encode(
                        mcrypt_encrypt(
                                MCRYPT_RIJNDAEL_256, $AESKey, $value, MCRYPT_MODE_ECB, mcrypt_create_iv(
                                        mcrypt_get_iv_size(
                                                MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)
                        )
                ), "\0"
        );
    }

    /**
     * Performs the decryption of a value encrypted using AES schema
     * @param string $value The value to be decrypted
     * @param string $AESKey The key that the value was encrypted with
     * @return string Original value
     */
    public static function decrypt($value, $AESKey) {
        return rtrim(
                mcrypt_decrypt(
                        MCRYPT_RIJNDAEL_256, $AESKey, base64_decode($value), MCRYPT_MODE_ECB, mcrypt_create_iv(
                                mcrypt_get_iv_size(
                                        MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB
                                ), MCRYPT_RAND
                        )
                ), "\0"
        );
    }

}
