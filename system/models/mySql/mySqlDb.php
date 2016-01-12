<?php
/**
 * Nombre           : mySqlDb.php                                                   
 * Autor            : Stefan 
 * Version          :   
 * Descripcion      : En este archivo se alojaran las funciones que realizaran 
 *                  : operaciones DIRECTO sobre una DB MySql                        
 * Fecha            :                                             
 * Observaciones    :                               
 *
 * Para poder utilizar  este modulo, se deben definir algunas variables globales
 * de configuracion. Se deja una lista a modo de ejemplo:
 * 
 *  $_serverHost    = "localhost";
 *  $_userName      = "root";
 *  $_port          = "3306";
 *  $_password      = "";
 *  $_schema        = "my_db";
 *  $_char_set      = "utf8";
 */

require_once ($_base."/sistema/debug/debug.php");

$archivoPHP = basename($_SERVER['PHP_SELF']);

/**
 * Establece una coneccion con la DB 
 * @return recurso MySql en exito
 * @return bool FALSE si hubo errores
 */
function conectarDB()
{
    global $_serverHost;
    global $_userName;
    global $_password;
    global $_schema;
    global $_char_set;
    
    global $archivoPHP;
    
    $retorno = false;
    
    $conn = @mysql_connect($_serverHost, $_userName ,$_password);
    if($conn == false)
    {
        gestionarError($archivoPHP, mysql_error());
        $retorno = false;
    }  
    else
    {
        $esquema = mysql_select_db($_schema ,  $conn);
        if($esquema == false)
        {
            gestionarError($archivoPHP, mysql_error());
            $retorno = false;
        }
        else
        {
            mysql_set_charset($_char_set,$conn); 
            $retorno = $conn;
        }    
        
    }    
    return $retorno;
}

/**
 * Realiza la desconeccion de la DB
 * @param recurso MySQL $conn
 * @return bool TRUE si logro desconeccion o FALSE si hubo errores
 */
function desconectarDB($conn)
{
    global $archivoPHP;
    
    $retorno = false;
    
    if(mysql_close($conn) == false)
    {
        gestionarError($archivoPHP, mysql_error());
        $retorno = false;
    }
    else
    {
        $retorno = true;
    }
    
    return $retorno;
}

/**
 * Realiza la ejecucion de una Consulta SQL
 * @param string $query
 * @return resultset para consulta del tipo SELECT 
 * @return bool TRUE si hubo exito, FALSE si hubo errores, para el resto
 * de las consultas
 */
function ejecutarConsulta($query)
{
    global $archivoPHP;
    
    $retorno = false;
    
    $conn = conectarDB();
    if($conn != false)
    {
        $resultado  = mysql_query($query);
        
        if($resultado == false)
        {
           gestionarError($archivoPHP, mysql_error(),$query);         
           $retorno = false;
        }     
        else
        {
            $retorno = $resultado;
        }
        desconectarDB($conn);
    }  
    else
    {
        //Este error ya esta contemplado en la funcion conectarDB
        $retorno = false;
    }    
    
    return $retorno;
}
/**
 * Realiza una transaccion de multiples consultas<br>
 * Al iniciar la transaccion se deshabilita el modo Autocommit de la
 * DB impidiendo que las transacciones queden permanentemente en memoria<br>
 * Si TODAS las transacciones fueron exitosas, se realiza el COMMIT de todo
 * el proceso. <br>De lo contrario se realiza un ROLLBACK para dejar todo en 
 * su estado anterior
 * @param array $arrayQuery <p>Array con todas las consultas que se desean ejecutar</p>
 * @return boolean <b>TRUE</b> si se realizo el COMMIT <br><b>FALSE</b> si se realizo el ROLLBACK
 */
function ejecutarTransaccion($arrayQuery)
{
    global $archivoPHP;
    
    $retorno    = false;
    $procesoOK  = true;
    
    $conn = conectarDB();
    if($conn != false)
    {
        mysql_query("BEGIN"); 
        foreach($arrayQuery as $query)
        {
            //$query      = @mysql_real_escape_string($query);
            $resultado  = mysql_query($query);
            
            if($resultado == false)
            {
                $procesoOK = false;
                gestionarError($archivoPHP, mysql_error(),$query); 
                break;
            }     
        }    

        if($procesoOK == true)
        {
            mysql_query("COMMIT");
            $retorno = true;
        }
        else
        {
            mysql_query("ROLLBACK");
            $retorno = false;
        }    
        
        desconectarDB($conn);
    }  
    else
    {
        //Este error ya esta contemplado en la funcion conectarDB
        $retorno = false;
    }    
    
    return $retorno;
}
/**
 * Convierte el formato resultset de una consulta, en un array asociativo
 * Los Strings con los que realizara la asociacion del array, se reciben
 * por parametro ($arrayColumnas)
 * @param resultset $resultado
 * @return array() con valores asociados
 * @return bool FALSE si hubo errores o la consulta es vacia 
 */
function obtenerArray($resultado)
{
    global $archivoPHP;
    
    $retorno = false;
    
    if($resultado != false)
    {
        $temp = mysql_fetch_array($resultado);
        if($temp != false)
        {
            //GENERO UN ARRAY DE FILAS 
            //PARA PODER HACER EL MAPEO DESPUES
            $filas 	= array();
            $indice	= 0;

            while($temp)
            {
                    $filas[$indice]	= $temp;
                    $temp = mysql_fetch_array($resultado);
                    $indice++;
            }

            //HAGO EL MAPEO         
            try
            {
                $retorno	= array();
                $indice     = 0;
                foreach($filas as $fila)
                {
                    while(list($key, $val) = each($fila)) 
                    {
                            $retorno[$indice][$key] = $val;
                    }
										
                    $indice++;
                }
               
            }catch(Exception $e)
            {
                gestionarError($archivoPHP, $e->getMessage());
            }
            
        }
        else
        {
            $retorno = false;
        }    
    }
    else
    {
        $retorno = false;
    }    
    
    return $retorno;
}
?>
