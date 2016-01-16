<?php

/**
 * Nombre           : persistencia_mysql.php                                                          
 * Autor            : Stefan
 * Version          : 1.3                                                       
 * Descripcion      : Archivo encargado de alojar las operaciones comunes                                                         
 *                  : que se realizan sobre registros en una Base de Datos (DB) MySql                                                         
 * Fecha            : 22/05/2014                                                         
 * Observaciones    :    
 */

//MODULO DE CONEXION PARA BASES DE DATOS MYSQL
require_once($_base."/sistema/persistencia/mySql/mySqlDb.php");

/**
 * Obtiene un array asociativo de un pedido realizado a la DB<br>
 * Esta funcion esta pensada para pedidos cuyo resultado, debe ser paginado
 * y se le deben aplicar multiples filtros (criterio)
 * @param string $campos <p> Cadena con las columnas que se esperan obtener de 
 * la DB. <br>Esta se concatenara a la sentencia SQL, asi que es importante que 
 * se respete la estrucutra de la misma<br>
 * EJ: nombreColumna1 AS campoMapeado1, nombreColumna2 AS campoMapeado2, ...
 * </p>
 * @param string $tabla <p>El nombre de la tabla/tablas, de la cual quiero 
 * los datos</p>
 * @param string $criterio <p>El criterio con el que se vaya a realizar 
 * la consulta. <br>Tener en cuenta que esta cadena se concatenara a la 
 * sentencia SQL, asi que es importante que se respete la estrucutra de 
 * la misma <br>
 * Ej: WHERE idCliente=4 </p>
 * @param integer $inicio <p>El numero de registro por el que quiero empezar
 * a visualizar los resultados de la consulta<br>
 * <b>El primer valor del LIMIT</b></p>
 * @param integer $tamanio <p>La cantidad de registros que quiero, a partir
 * del valor de inicio<br>
 * <b>El segundo valor del LIMIT</b></p>
 * @param string $ordenarPor <p>
 * Cadena con el criterio de orden que se quiere aplicar al resultado
 * <br>
 * Ej: order by clienteNombre
 * </p>
 * @return boolean <p><b>FALSE</b> si hubo errores, o no hay registros 
 * que devolver</p>
 * @return array <p><b>Array asociativo</b> con los registros obtenidos 
 * de la consulta</p>
 */
function obtenerPedido($campos,$tabla,$criterio = "",$inicio = -1,$tamanio = 0,$ordenarPor = "")
{
    $retorno = false;
    
    $query = "SELECT ".$campos." FROM ".$tabla." ".$criterio." ".$ordenarPor;
    
    if($inicio >= 0)
    {
        $query .= " LIMIT ".$inicio;
    }
    
    if($tamanio > 0)
    {
        $query .= ",".$tamanio;
    }
    
   //echo "<br>".$query."<br>";
    
    $resultado  = ejecutarConsulta($query);
    $aux        = obtenerArray($resultado);
    
    if($aux != false)
    {
        $retorno = $aux;
    }
    else
    {
        $retorno = false;
    }    
        
    return $retorno; 
   
}
/**
 * Realiza el inserte de un registro en la DB
 * @param string $tabla <p>La tabla donde se realizara el insert</p>
 * @param array $arrayValor <p>Array asociativo con los datos a insertar.<br>
 * Los nombres de las columnas se obtendran de las claves del array, asi que
 * es obligatorio, que las claves del array coincidan con las columnas 
 * de la tabla</p>
 * @return boolean <p><b>TRUE</b> si hubo exito <br>
 * <b>FALSE</b> si hubo errores
 * </p>
 */
function insertarRegistro($tabla,$arrayValor)
{
    $retorno = false;
    
    $query = "INSERT INTO ".$tabla."(";
    
    while(list($columna,$valor) = each($arrayValor))
    {
        $query .= $columna.",";
    }
    $query = rtrim($query,',').") VALUES(";
   
    reset($arrayValor);
    while(list($columna,$valor) = each($arrayValor))
    {
        $query .= "'".$valor."',";
    }
    $query = rtrim($query,',').")";
   
    //echo "<br>".$query."<br>";
        
    $resultado = ejecutarConsulta($query);
    
    if($resultado != false)
    {
        $retorno = true;
    }
    
    return $retorno;
}
/**
 * Realiza el update de uno o mas registros en la DB
 * @param string $tabla <p>La tabla donde se realizara el update</p>
 * @param array $arrayValor <p>Array asociativo con los datos a actualizar.<br>
 * Los nombres de las columnas se obtendran de las claves del array, asi que
 * es obligatorio, que las claves del array coincidan con las columnas 
 * de la tabla</p>
 * @param string $criterio <p>El criterio con el cual se realizara 
 * el proceso de modificacion (El WHERE...)</p>
 * @return boolean <p><b>TRUE</b> si hubo exito <br>
 * <b>FALSE</b> si hubo errores
 * </p>
 */
function actualizarRegistro($tabla,$arrayValor,$criterio = "")
{
    $retorno = false;
    
    $query = "UPDATE ".$tabla." SET ";
    
    while(list($columna,$valor) = each($arrayValor))
    {
        $query .= $columna." = '".$valor."',";
    }
    
    $query = rtrim($query,',')." ";
    
    $query .= $criterio;
    
    //echo "<br>".$query."<br>";
    
    $resultado = ejecutarConsulta($query);
    
    if($resultado != false)
    {
        $retorno = true;
    }
    
    return $retorno;
}
/**
 * Realiza el delete de uno o varios registros en la DB
 * @param string $tabla <p>La tabla del/de los registro/s a eliminar</p>
 * @param string $criterio <p>El criterio con el cual se realizara 
 * el proceso de eliminacion (El WHERE...)</p>
 * @return boolean <p><b>TRUE</b> si hubo exito <br>
 * <b>FALSE</b> si hubo errores
 * </p>
 */
function eliminarRegistro($tabla,$criterio)
{
    $retorno = false;
    
    $query = "DELETE FROM ".$tabla." ".$criterio;
    
    $resultado = ejecutarConsulta($query);
    
    if($resultado != false)
    {
        $retorno = true;
    }
    
    return $retorno;
}
/**
 * Realiza la ejecucion de un Store Procedure determinado.<br>
 * Para realizar el CALL, el SP debe ser pasado como argumento con 
 * LA TOTALIDAD de sus parametros
 * @param string $procedure <p>String con el SP completo</p>
 * @return boolean <p><b>TRUE</b> en caso de exito<br> 
 * <b>FALSE</b> caso contrario</p>
 */
function llamarProcedure($procedure)
{
    $retorno = false;
    
    $query = "CALL ".$procedure;
    
    //echo "<br>$query<br>";
    
    $resultado = ejecutarConsulta($query);
    
    if($resultado != false)
    {
        $retorno = true;
    }
    
    return $retorno;
}
/**
 * Gestiona la ejecucion de una Transaccion 
 * @param array $transaccion <p>Array con todas las consultas a ejecutar</p>
 * @return boolean <p><b>TRUE</b> si la transaccion fue exitosa <br>
 * <b>FALSE</b> si hubo errores</p>
 */
function realizarTransaccion($transaccion)
{
    $retorno = false;
    
    $resultado = ejecutarTransaccion($transaccion);

    if($resultado != false)
    {
        $retorno = true;
    }
    
    return $retorno;
}
?>
