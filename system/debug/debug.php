<?php
/**
 * Nombre           : debug.php                                                
 * Autor            : Stefan                                           
 * Descripcion      : En este archivo se alojan las funciones que ayudan       
 *                  : a depurar la aplicacion (Hacer logs, y demas...)         
 * Fecha            : 08/08/2013                                               
 * Observaciones    :                                                          
 **/

/**
 * Graba en un archivo *.log un error que se haya producido en la ejecucion
 * del programa
 * @global string $_debug_path
 *      El path donde se alojara el archivo. Ver config.php
 * @param string $archivoPHP
 *      El archivo donde se produjo el error
 * @param string $texto 
 *      El error o registro que se quiera dejar en el archivo
 */
function registrarError($archivoPHP,$texto)
{
    global $_debug_path;
    
    $ddf = fopen($_debug_path,'a');
    fwrite($ddf,"[".date("d-m-Y H:i:s")."]\t". $archivoPHP ."\tError: $texto" . PHP_EOL);
    fclose($ddf);
}
/**
 * Realiza la gestion de un error o una excepcion producida, discriminando
 * segun el modo de operacion (Debug o Release)
 * @global type $_debug_error
 *      La pagina a la que se redireccionara en caso de error en el modo
 *      RELEASE
 * @param type $archivoPHP
 *      El nombre del archivo en el cual se produjo el error
 * @param type $error 
 *      La descripcion del error
 */
function gestionarError($archivoPHP,$error,$query = "")
{
    global $_debug_error;
    global $_debug_mode;
    
    registrarError($archivoPHP,$error."\nQuery : ".$query);
        
    switch($_debug_mode)
    {
        case DEBUG:
            echo "<b>ERROR</b><hr>";
            echo "<b>Archivo:</b> ".$archivoPHP."<br>";
            echo "<br>";
            echo "<b>Desc:</b> ".$error."<br>";
            echo "<br>";
            if($query != "")
            {
                echo "<b>Query:</b> ".$query."<br>";
            }
            echo "<hr><br>";
            break;
        case RELEASE:
            header("Location: ".$_debug_error);
            exit();
            break;
        default:
            break;
    }
    
} 


?>
