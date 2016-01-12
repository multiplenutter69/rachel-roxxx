<?php

/**
 * Nombre           : arrays.php                                                         
 * Autor            : Stefan
 * Version          : 1.0                                                        
 * Descripcion      : En este modulo se almacenaran todas las funciona que 
 *                  : se encarguen de facilitar el manejo de arrays, tanto 
 *                  : asociativos, como numericos.                                                         
 * Fecha            : 19/02/2014                                                          
 * Observaciones    :     
 */

/**
 * Determina si se encuentra seteado la posicion del valor del array recibido <br>
 * Si lo esta, lo devuelve intacto <br>
 * Si no, devuelve la cadena vacia
 * @param type $valor <p>
 * Array en la posicion que se quiera testear
 * </p>
 * @return String <p>
 * El valor de la posicion del array si existe <br>
 * Cadena vacia de no existir
 * </p>
 */
function devolverSiExiste($valor)
{
    $retorno = "";
    
    if(isset($valor))
    {
        $retorno  = $valor;
    }
    
    return $retorno;
}
/**
 * Realiza la codificacion de un array, para ser utilizado como parametro
 * en una URL
 * @param array $array <p>El array a codificar</p>
 * @return string <p>El array serializado y codificado</p>
 */
function codificarArrayURL($array)
{
    $retorno    = "";
    $temp       = serialize($array);
    $retorno    = urlencode($temp);
    
    return $retorno;
}
/**
 * Realiza la decodificacion de un array que se ha enviado codificado como 
 * parametro en una URL
 * @param string $valor <p>El valor a decodificar</p>
 * @return array <p>El array deserializado y decodificado</p>
 */
function decodificarArrayURL($valor)
{
    $retorno    = array();
    
    $temp       = urldecode($valor);
    $retorno    = unserialize($temp);
    
    return $retorno;
}
/**
 * Indica si un array, esta contenido en otro array
 * @param array $array1 <p>El array que queremos consultar</p>
 * @param type $array2 <p>El array en el que deberia estar contenido array1</p>
 * @return boolean <p><b>TRUE</b> si array1 esta contenido en array2<br>
 * <b>FALSE</b> caso contrario</p>
 */
function arrayContiene($array1, $array2)
{
    $retorno = true;
    
    foreach($array1 as $valor)
    { 
        if(array_serch($valor,$array2) == false)
        {
            $retorno = false;
            break;
        } 
    }
    
    return $retorno;
}
?>
