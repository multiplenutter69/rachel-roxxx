<?php

/**
 * Nombre           : url.php                                                          
 * Autor            : Stefan
 * Version          : 1.1                                                        
 * Descripcion      : En este archivo se alojaran todas las fucnioens que 
 *                  : realizan operaciones sobre las URL del proyecto.                                                         
 *                  :                                                          
 * Fecha            : 29/09/2014                                                          
 * Observaciones    :     
 */

/**
 * Obtiene los argumentos que se pasan por GET de una URL<br>
 * Se parsea la cadena buscando el caracter '?'
 * @param string $url <p>La URL a parsear</p>
 * @return string <p>Cadena con los argumentos de la URL,<br>
 *  <b>Los argumentos no estan parseados</b></p>
 */
function obtenerArgumentosURL($url)
{
    $retorno = "";
    if (preg_match("/\?/", $url)) 
    {
        $array = explode("?", $url);
        $retorno =  "?" . $array[1];
    }
    
    return $retorno;
}
/**
 * Convierte una URL en una URL Limpia<br>
 * Para eso, reemplaza caracteres espciales, especiales latinos, espacios
 * y enters<br>
 * <b>EJ</b>: cliente.php?id=1 => cliente/1
 * @param string $url <p>URL "sucia"</p>
 * @return string <p>La URL "limpia"</p>
 */
function obtenerUrlAmigable($url)
{
    $url = strtolower($url);

    //REEMPLAZO DE CARACTERES ESPECIALES LATINOS
    $find   = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
    $repl   = array('a', 'e', 'i', 'o', 'u', 'n');
    $url    = str_replace($find, $repl, $url);

    //TRANSFORMA ESPACIOS Y ENTERS EN GUIONES
    $find   = array(' ', '&', '\r\n', '\n', '+');
    $url    = str_replace($find, '-', $url);

    //ELIMINA Y REEMPLAZA CARACTERES ESPECIALES
    $find   = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
    $repl   = array('', '-', '');
    $url    = preg_replace($find, $repl, $url);

    return $url;
}