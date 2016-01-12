<?php

/**
 * Nombre           : persistencia_ejemplo.php                                                          
 * Autor            : Stefan
 * Version          :                                                        
 * Descripcion      : Archivo encargado de alojar las operaciones de persistencia 
 *                  : para este ejemplos 
 * Fecha            :                                                       
 * Observaciones    : 
 */

//DEPENDENCIA AL MODULO DE PERSISTENCIA
require_once($_base."/sistema/persistencia/mySql/persistencia_mysql.php");

function obtenerEjemplo($criterio = "", $inicio = -1, $limite = 0)
{
    $retorno = array();
        
    $campos     = "*";
    $tabla      = "ejemplo";
    $consulta   = obtenerEjemplo($campos, $tabla, $criterio, $inicio, $limite);
        
    if($consulta != false)
    {
        $retorno = $consulta;
    }
    
    return $retorno;
}

function insertarEjemplo($ejemplo)
{
    $retorno = false;
    
    $tabla      = "ejemplo";
    $operacion  = insertarRegistro($tabla, $ejemplo);
    
    if($operacion != false)
    {
        $retorno = true;
    }
    
    return $retorno;
}

function actualizarEjemplo($ejemplo, $criterio = "") 
{
    $retorno = false;

    $tabla = "ejemplo";
    $operacion = actualizarRegistro($tabla, $ejemplo, $criterio);

    if ($operacion != false) 
    {
        $retorno = true;
    }

    return $retorno;
}

function bajaEjemplo($criterio)
{
    $retorno = false;
    
    $tabla      = "ejemplo";
    $operacion  = eliminarRegistro($tabla, $criterio);
    
    if($operacion != false)
    {
        $retorno = true;
    }
    
    return $retorno;
    
}