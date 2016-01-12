<?php
/**
 * Nombre       : seguridad.php                                                
 * Autor        : Stefan                                               
 * Fecha        : 03/07/2013                                                   
 * Descripcion  : En este archivo se alojaran todas las funciones que realicen 
 *              : verificaciones de seguridad al contenido de los campos       
 *              : Esto ser realiza para prevenir ataques al stitio, como       
 *              : SQL Injection, entre otros                                   
 **/


require_once("AES.php");

/**
 * Realiza la limpieza de un campo de entrada para su uso<br>
 * Analiza el campo buscando valores incorrectos que puedan degenerarse
 * en un XSS o SQLI. Para eso se utilizan funciones nativas de PHP que realizan
 * el saneamiento y limpieza de los campos como filter_var()
 * 
 * @param string $campo <p>El campo a analizar</p>
 * @param string $filtro <p> El tipo de filtro que se le aplicara
 * <br>Ejemplos:<br><br>FILTER_VALIDATE_INT, FILTER_SANITIZE_SPECIAL_CHARS</p>
 * @return string el campo analizado 
 */
function analizarCampo($campo, $filtro)
{
    $campo = trim($campo);
    $campo = stripslashes($campo);
    $campo = eliminarPalabrasConflictivas($campo);
    $campo = filter_var($campo, $filtro);

    return $campo;
   
}

/**
 * Recibe un campo y lo filtra, eliminandole los espacios, comas, y 
 * caracteres especiales
 * @param string $campo
 * @return string el campo filtrado (puede ser vacio) 
 */
function limpiarCampo($campo)
{
    echo "<br>limpiarCampo: Esta funcion a quedado en desuso<br>";
//    $filtro     = "/[\s,'-]+/";
//    $auxiliar   = preg_split($filtro, $campo);
//    
//    $retorno    = $auxiliar[0]; 
//    
//    return $retorno;
}
/**
 * Recibe un campo y elimina las palabras conflictivas, 
 * como por ejemplo SELECT, INSERT, DELETE, DROP, etc...
 * 
 * NOTA: En un futuro, se puede utilizar esta misma funcion para
 * eliminar insultos o SPAM de un texto
 * @param string $campo
 * @return string el campo fitrado 
 */
function eliminarPalabrasConflictivas($campo)
{
    //#Valor#i para que sea case sensitive
    $palabrasConflictivas = array(
        "#drop #i",
        "#select #i",
        "#insert #i",
        "#update #i",
        "#delete #i"
    );

    $retorno = preg_replace_callback($palabrasConflictivas, "reemplazarPalabrasConflictivas", $campo);

    return $retorno;
}
/**
 * Referenciada desde "eliminarPalabrasConflictivas",
 * recibe una palabra conflictiva y la elimina caracter a caracter
 * 
 * Ej:
 *  IN: "JuDROPan" 
 *  OUT:"Juan"
 * 
 * NOTA: Ver documentacion "preg_replace_callback" 
 * 
 * @param type $palabra
 * @return type 
 */
function reemplazarPalabrasConflictivas($palabra)
{
    return substr($palabra [0] , 0, 0);
}
/**
 * Genera un codigo aleatorio en funcion de la fecha y hora actuales
 * @return string el codigo 
 */
function obtenerCodigo($longitud = 127)
{
    $retorno = substr(md5(microtime()),0,$longitud);
    
    return $retorno;
}
/**
 * Obtiene el IP del usuario conectado a la plataforma
 * NOTA: No funciona con proxis, por mas que el codigo demuestre que deberia
 * @return string La direccion IP del usuario conectado
 */
function obtenerIP() 
{
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) 
    {
        $retorno = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    elseif (isset($_SERVER['HTTP_VIA'])) 
    {
        $retorno = $_SERVER['HTTP_VIA'];
    }
    elseif (isset($_SERVER['REMOTE_ADDR'])) 
    {
        $retorno = $_SERVER['REMOTE_ADDR'];
    }
    elseif (isset($_SERVER['HTTP_CLIENT_IP']))
    {
        $retorno = $_SERVER['HTTP_CLIENT_IP'];
    }
    else 
    {
        $retorno = "DESCONOCIDO";
    }
    
    return $retorno;
}
/**
 * Realiza el proceso de Hash de una cadena, bajo una funcion determianda
 * @param string $cadena <p>La cadena a Hashear</p>
 * @param integer $metodo <p>La funcion de Hash a aplicar
 * <br>Ver: config/define.php para ver el listado de funciones disponibles </p>
 * @return string <p>La cadena Hasheada</p>
 */
function hashValor($cadena,$metodo = SHA256)
{
    switch($metodo)
    {
        case MD5:
            $retorno = hash("md5",$cadena);
            break;
        case SHA256:
            $retorno = hash("sha256",$cadena);
            break;
        case HAVALL11604:
            $retorno = hash("haval160,4",$cadena);
            break;
        default:
            $retorno = hash("sha256",$cadena);
            break;
    }
    
    return $retorno;
}
/**
 * Realiza la Codificacion de un valor, utilizando una clave privada previamente
 * establecida
 * @param string $valor <p>La cadena a codificar</p>
 * @return string <p>La cadena codificada o la cadena vacia, si se produjo un 
 * error</p>
 */
function encriptarValor($valor)
{
    return encriptar($valor, CLAVE_AES);
}
/**
 * Realiza la Decodificacion de un valor encriptado
 * @param string $valor <p>El valor a desencriptar</p>
 * @return string <p>La cadena desencriptada</p>
 */
function desencriptarValor($valor)
{
    return desencriptar($valor, CLAVE_AES);
}
/**
 * Genera una imagen para ser utilizada como captcha<br>
 * Recibe un codigo y retorna la imagen captcha codificada en base 64
 * @param string $codigo <p>El codigo para generar el captcha.<br>
 * Puede ser alfanumerico</p>
 * @return string<p>Retorna la imagen codificada en base 64</p>
 */
function obtenerCaptcha($codigo)
{
    $nombreCaptcha  = dirname(__FILE__)."/captcha". $codigo .".jpg";
    $imagen         = imagecreatefromjpeg(dirname(__FILE__)."/fondo_captcha_60_30.jpg"); 
    $colorTexto     = imagecolorallocate($imagen, 0, 0, 0);

    //ESCRIBO EL CODIGO Y LO GUARDO EN ARCHIVO TEMPORAL
    imagestring($imagen,5, 5, 5, $codigo, $colorTexto);
    imagejpeg($imagen, $nombreCaptcha);
    
    //LO LEVANTO Y CODIFICO EN BASE 64
    $type   = pathinfo($nombreCaptcha, PATHINFO_EXTENSION);
    $data   = file_get_contents($nombreCaptcha);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    
    imagedestroy($imagen);
    unlink($nombreCaptcha);
    
    return $base64;
}

?>
