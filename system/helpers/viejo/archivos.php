<?php
/*******************************************************************************
 * Nombre           : archivos.php                                             *
 * Autor            : Stefan                                           *
 * Descripcion      : En este archivo se alojan todas las funciones  que       *
 *                  : realizan operaciones con Archivos                        *
 *                  :                                                          *
 * Fecha            : 24/09/2013                                               *
 * Observaciones    :                                                          *
 *******************************************************************************/

/**
 * Realiza el copy de un archivo desde un directorio a otro
 * @param $_FILE['tmp_name] $tmpNameArchivo
 *      El name del archivo que se desea copiar
 * @param string $rutaDestino
 *      La ruta a la que se va a copiar el archivo
 * @return boolean 
 *      TRUE si el proceso de copiado fue exitos
 *      FALSE si hubo errores
 */
function subirArchivo($tmpNameArchivo,$rutaDestino)
{
    $retorno = true;
    if(copy($tmpNameArchivo,$rutaDestino) == false)
    {
        $retorno = false;
    }
    
    return $retorno;
}
/**
 * Elimina un archivo subido al servidor
 * @param type $rutaArchivo
 * @return boolean 
 *      TRUE    si hubo exito
 *      FALSE   si hubo errores
 */
function eliminarArchivoSubido($rutaArchivo)
{
    $retorno = false;
    
    if(unlink($rutaArchivo) != false)
    {
        $retorno = true;
    }    
    
    return $retorno;
}
/**
 * 
 * @param type $cadenaUri
 * @param type $nombreArchivo
 */
function convertirURI($cadenaUri,$nombreArchivo)
{
    $retorno = "";
    
    $uri = substr($cadenaUri, strpos($cadenaUri,",") + 1);
    if(file_put_contents("./".$nombreArchivo, base64_decode($uri)) != false)
    {
        $retorno = $nombreArchivo;
    }
    
    return $retorno;
}
?>
