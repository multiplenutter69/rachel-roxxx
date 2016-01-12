<?php

/**
 * Nombre           : control_commons.php                                                         
 * Autor            : Stefan
 * Version          :                                                       
 * Descripcion      : En este archivo se alojaran las funciones comunes al
 *                  : proyecto. Controlador comun al proyecto                                               
 * Fecha            : 
 * Observaciones    :     
 */

//MODULOS
require_once ($_base."/sistema/modulos/correo/gestionMail.php");
require_once ($_base."/sistema/modulos/seguridad/seguridad.php");

require_once ($_base."/sistema/modulos/archivos.php");
require_once ($_base."/sistema/modulos/arrays.php");
require_once ($_base."/sistema/modulos/cadenas.php");
require_once ($_base."/sistema/modulos/fechas.php");
require_once ($_base."/sistema/modulos/log.php");
require_once ($_base."/sistema/modulos/sesion.php");
require_once ($_base."/sistema/modulos/url.php");
require_once ($_base."/sistema/modulos/validacion.php");

/**
 * Guarda un valor en una variable de sesion propia de este proyecto
 * <br>
 * A cada variable de sesion, se le agrega como prefijo "nombreProyecto_",
 * de esa forma, todas las variables de sesion de ese proyecto, se encontraran
 * nombradas de la misma forma
 * @param string $clave <p>La clave con la cual se desea guardar el valor
 * dentro del array de sesiones.<br> A este valor luego se le concatenara
 * el nombre del proyecto</p>
 * @param string $valor <p>El valor a almacenar</p>
 */
function guardarEnSesion($clave,$valor)
{
    global $_proyecto;
   
    $claveProyecto      = $_proyecto."_".$clave;
    $valorEncriptado    = encriptarValor($valor);    
    
    guardarValorEnSesion($claveProyecto, $valorEncriptado);
}
/**
 * Obtiene un valor alamacenado en una variable de sesion propia de 
 * este proyecto.
 * <br>
 * A cada variable de sesion, se le agrega como prefijo "nombreProyecto_",
 * de esa forma, todas las variables de sesion de ese proyecto, se encontraran
 * nombradas de la misma forma
 * @param string $clave <p>La clave de la cual se desea obtener el valor
 * buscado</p>
 * @return string <p>La cadena solicitada en caso de exito<br>
 * La cadena vacia si hubo errores</p>
 */
function obtenerDeSesion($clave)
{
    global $_proyecto;
    
    $claveProyecto  = $_proyecto."_".$clave;
    $valor          = obtenerValorDeSesion($claveProyecto);
    $retorno        = $valor != false ? desencriptarValor($valor): "";

    return $retorno;
}
/**
 * Elimina un valor alamacenado en una variable de sesion propia de 
 * este proyecto.
 * <br>
 * A cada variable de sesion, se le agrega como prefijo "nombreProyecto_",
 * de esa forma, todas las variables de sesion de ese proyecto, se encontraran
 * nombradas de la misma forma
 * @param string $clave <p>La clave de la cual se desea obtener el valor
 * buscado</p>
 */
function eliminarDeSession($clave)
{
    global $_proyecto;
    
    $claveProyecto = $_proyecto."_".$clave;
    
    eliminarValorDeSesion($claveProyecto);
}
/**
 * Refresca el tiempo de duracion de la sesion<br>
 * La contabilizacion se realiza a mano, ya que ninguna de las configuraciones
 * sobre el servidor demostro ser eficaz<br>
 * El periodo de refresco puede ser configurable desde el archivo config
 * del proyecto
 */
function refrescarSesion()
{
    global $_sesion_tiempo;
    
    $temp = obtenerDeSesion("created");
    if($temp != false)
    {
        if (time() - $temp > $_sesion_tiempo) 
        {
            actualizarSesion();   
            guardarEnSesion("created", time());  
        }

    }
}
/**
 * Realiza el cierre de sesion del proyecto.<br>
 * Elimina todas las variables de sesion asociadas con el proyecto
 */
function cerrarSesionProyecto()
{
    global $_proyecto;
    cerrarSesion($_proyecto);
        
}
/**
 * Controla que el proyecto se encuentre habilitado.<br>
 * En caso de no estarlo, redirecciona a una pagina de 
 * "Service Unabailable" 
 * @global type $_proyecto_enabled <p>Chequea el estado del proyecto
 *  (ver Config.php)</p>
 */
function habilitarProyecto($redirect = true)
{
    global $_base_url;
    global $_proyecto_enabled;
    global $_proyecto_enabled_page;
    
    $retorno = false;
    
    if($redirect)
    {
        if($_proyecto_enabled != ENABLED)
        {
            //SE CIERRA SESION COMPLETA DEL PROYECTO, POR SEGURIDAD
            cerrarSesionProyecto();
            header("Location: ". $_base_url . $_proyecto_enabled_page);
            exit();
        }
    }
    else
    {
        $retorno = $_proyecto_enabled == ENABLED ? true : false;
    }
    
    return $retorno;
}
/**
 * Genera una imagen para ser utilizada como captcha
 * <br>La imgen se genera superponiendo un fondo con un codigo aleatorio
 * @return string html con la imagen final
 */
function generarImagenCaptcha()
{
    $codigo = substr(obtenerCodigo(), 0, 6);
    guardarEnSesion("captcha", $codigo);
    return obtenerCaptcha($codigo);
}
