<?php

/**
 * Nombre           : gestionExcel.php                                                      
 * Autor            : Stefan
 * Version          :                                                         
 * Descripcion      : Archivo PHP encargado de proveer funciones que permitan                                                           
 *                  : la gestion de un archivo excel. En el siguiente archivo
 *                  : se enmascaran  en funciones, la coleccion de servicios
 *                  : y funcionalidades provistas por la libreria PHPExcel 
 *                  : desarrollada en OOP                                  
 * Fecha            : 14/10/2015                                                          
 * Observaciones    :     
 */

//PHPExcel
require_once(dirname(__FILE__)."/PHPExcel/IOFactory.php");

/**
 * Realiza la carga del archivo Excel a leer. 
 * @param string $rutaArchivo <p>Ruta donde esta ubicado el archivo. Es ruta + nombre de archivo con extension</p>
 * @return boolean <p><b>False</b> si hubo errores</p>
 * @return obj <p><b>Objeto PHPExcel</b> instanciado con el archivo leido</p>
 */
function cargarArchivoExcel($rutaArchivo)
{
    try
    {
        $retorno = PHPExcel_IOFactory::load($rutaArchivo);
    } 
    catch (Exception $ex) 
    {
        //echo $ex->getMessage()."<br>";
        $retorno = false;
    }
    
    return $retorno;
}
/**
 * Crea un Objeto Hoja a partir de un Archivo (Objeto PHPExcel)
 * <br>Cada Hoja tiene un numero de posicion que va desde 0 hasta N - 1, siendo N
 * el numero de hojas existentes en el archivo
 * @param obj $phpExcel <p>Objeto PHPExcel instanciado con el archivo a leer</p>
 * @param int $index <p>La posicion de la hoja a solicitar</p>
 * @return boolean <p><b>False</b> Si no quedan hojas por leer</p>
 * @return obj <p><b>Objeto WorkingSheet</b> instanciado con la hoja leida</p>
 */
function obtenerHojaExcel($phpExcel, $index)
{
    try
    {
        $hoja       = $phpExcel->getSheet($index);
        $retorno    = $hoja; 
    } 
    catch (Exception $ex) 
    {
        //echo $ex->getMessage()."<br>";
        $retorno = false;
    }
    
    return $retorno;
}
/**
 * Obtiene el nombre de la hoja leida
 * <br>Para poder utilizar esta funcion, se debe haber realizado la lectura 
 * de la hoja mediante la funcion <i>obtenerHojaExcel()</i>
 * @param obj $hoja <p>Objeto WorkingSheet instanciado con la hoja leida</p>
 * @return string <p>El nombre de la hoja</p>
 */
function obtenerNombreHojaExcel($hoja)
{
    try
    {
        $retorno = $hoja->getTitle();
    } 
    catch (Exception $ex) 
    {
        //echo $ex->getMessage()."<br>";
        $retorno = "";
    }
    return $retorno;
}
/**
 * Obtiene el numero de indice de la ultima columna efectivamente utilizada 
 * de una hoja  leida.<br> El valor devuelto corresponde a un numero de posicion
 * de columna que comenzara en 0 y terminara en N-1, siendo N la cantidad de 
 * columnas utilizadas en esa hoja. 
 * @param obj $hoja <p>Objeto WorkingSheet instanciado con la hoja leida</p>
 * @return int <p>El numero con la posicion N-1</p>
 */
function obtenerMaxColumnaHojaExcel($hoja)
{
    try
    {
        $retorno = PHPExcel_Cell::columnIndexFromString($hoja->getHighestColumn());
    } 
    catch (Exception $ex) 
    {
        //echo $ex->getMessage()."<br>";
        $retorno = 0;
    }
    return $retorno;
}
/**
 * Obtiene el numero de ultima fila efectivamente utilizada de una hoja leida.
 * <br>El valor devuelto corresponde a un numero de fila que comenzara en 1 y 
 * terminara en N, siendo N la cantidad de filas efectivamente utilizadas en 
 * esa hoja
 * @param obj $hoja <p>Objeto WorkingSheet instanciado con la hoja leida</p>
 * @return int <p>El numero con la posicion N</p>
 */
function obtenerMaxFilaHojaExcel($hoja)
{
    try
    {
        $retorno = $hoja->getHighestRow();
    } 
    catch (Exception $ex) 
    {
        //echo $ex->getMessage()."<br>";
        $retorno = 1;
    }
    return $retorno;    
}
/**
 * Obtiene el valor de una determinada celda<br>El valor devuelto corresopndera
 * a la posicion definida por la hoja X, en las coordenadas fila Y, columna Z
 * @param obj $hoja <p>Objeto WorkingSheet instanciado con la hoja leida</p>
 * @param int $fila <p>El numero de fila donde se encuentra la celda a leer</p>
 * @param int $columna <p>La posicion de la columna donde se encuentra la celda a leer</p>
 * @return string <p>El valor de la celda leida</p>
 */
function obtenerCeldaHojaExcel($hoja, $fila, $columna)
{
    try
    {
        $retorno = $hoja->getCellByColumnAndRow($columna, $fila)->getValue();
    } 
    catch (Exception $ex) 
    {
        //echo $ex->getMessage()."<br>";
        $retorno = "";
    }
    return $retorno;
}