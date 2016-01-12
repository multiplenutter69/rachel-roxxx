<?php

/**
 * Nombre           : AES.php                                                         
 * Autor            : Desconocido
 * Version          : 1.0                                                        
 * Descripcion      : En este archivo se alojan las funciones encargadas de                                                         
 *                  : realizar la encriptacion y desencriptacion de datos 
 *                  : utilizando el esquema de cirfrado AES                                                         
 * Fecha            : 06/07/2015                                                         
 * Observaciones    : Se debe configurar el parametro global $_clave_AES con la
 *                  : clave de cifrado deseada, para el cifrado de variables
 *                  : de sesion    
 */

function encriptar($valor, $clave)
{
    return rtrim(
        base64_encode(
            mcrypt_encrypt(
                MCRYPT_RIJNDAEL_256,
                $clave, $valor, 
                MCRYPT_MODE_ECB, 
                mcrypt_create_iv(
                    mcrypt_get_iv_size(
                        MCRYPT_RIJNDAEL_256, 
                        MCRYPT_MODE_ECB), 
                    MCRYPT_RAND)
                )
            ), "\0"
        );
}

function desencriptar($value, $clave)
{
    return rtrim(
        mcrypt_decrypt(
            MCRYPT_RIJNDAEL_256, 
            $clave, 
            base64_decode($value), 
            MCRYPT_MODE_ECB,
            mcrypt_create_iv(
                mcrypt_get_iv_size(
                    MCRYPT_RIJNDAEL_256,
                    MCRYPT_MODE_ECB
                ), 
                MCRYPT_RAND
            )
        ), "\0"
    );
}