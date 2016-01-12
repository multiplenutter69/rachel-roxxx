<?php
/**
 * Nombre           : fechas.php                                               
 * Autor            : Stefan, Ing. Lucas Saclier                       
 * Version          : 1.2                                                      
 * Descripcion      : En este archivo se alojan todas las funciones que                          
 *                  : realizan operaciones con fechas y horas                  
 * Fecha            : 31/03/2014                                               
 * Observaciones    :                                                          
 * 
 * 31/03/2014 Stefan
 * > Se agregan las funciones esFeriado y proximoDiaHabil  
 * 26/05/2014 Stefan
 * > Se agrega funcion formatearHora
 * 23/09/2014 Stefan
 * > Se agrega funcion microtimeFloat()
 * > Se agrega funcion sumarTiempo()
 * > Se agrega funcion restarTiempo() 
 */

//<editor-fold defaultstate="collapsed" desc="FECHAS">
/**
 * Toma una fecha y le cambia el formato
 * @param date $fecha <p>La fecha a formatear</p>
 * @param string $formato <p>String con el formato esperado<br>(Respetando los
 * estandares de PHP)</p>
 * @return date $retorno <p>La fecha formateada</p>
 */
function formatearFecha($fecha,$formato)
{
    $retorno;
    
    $retorno = date($formato,strtotime($fecha)); 
    
    return $retorno;
}
/**
 * Compara si dos fechas son iguales
 * @param date $fecha1 <p>La fecha inicial a comparar</p>
 * @param date $fecha2 <p>La fecha final a comparar</p>
 * @return boolean <p><b>TRUE</b> sin son iguales<br>
 * <b>FALSE</b> caso contrario</p>
 */
function comparaFechas($fecha1,$fecha2)
{
    $retorno = false;
    
    $fecha1 = strtotime($fecha1);
    $fecha2 = strtotime($fecha2);

    if($fecha1 == $fecha2)
    {
        $retorno = true;
    }
        
    return $retorno;
}
/**
 * Realiza la resta entre dos fechas <br>
 * Para realizar la resta, convierte cada fecha a UNIX y realiza la operacion <br>
 * Para que el resultado se muestre en dias, se divide la diferencia por el valor
 * 86400, para que se muestre en horas por 3600 y para que se muestre en anios 31536000
 * @param string $fechaIni <p>El string con la fecha inicial</p>
 * @param string $fechaFin <p>El string con la fecha final</p>
 * @param integer $muestra <p>El tipo de resultado que quiero mostrar <br> 
 * 31536000 = muestra el resultado en anios <br>
 * 86400    = muestra el resultado en dias <br>
 * 3600     = muestra el resultado en horas <br>
 * </p>
 * @return integer <p> La diferencia entre fechas en el tipo previamente escogido </p>
 */
function restarFechas($fechaIni, $fechaFin,$muestra = 31536000) 
{ 
    $retorno;
    
    $inicial    = strtotime($fechaIni); 
    $final      = strtotime($fechaFin); 
    $diferencia = abs($final - $inicial); 

    $retorno = floor($diferencia /$muestra);

     
    return $retorno; 
} 
/**
 * Toma una fecha y le resta una cantidad n de dias
 * La n cantidad de dias, se recibe por parametro
 * @param String $fecha
 * @param Int $cantidad
 * @return Date La nueva Fecha 
 */
function decrementarFecha($fecha,$cantidad)
{
    $retorno = $fecha;
    
    $fechacomp  = strtotime($fecha);
    $fechacomp  = strtotime("-". $cantidad ." days", $fechacomp); //Le resto n días
    $fechacomp  = date("Y-m-d", $fechacomp);
    
    $retorno = $fechacomp;
    return $retorno;
}
/**
 * Toma una fecha y le suma una cantidad n de dias
 * La n cantidad de dias, se recibe por parametro
 * @param string $fecha <p>La fecha de inicio</p>
 * @param int $cantidad <p>La cantidad de dias a sumar</p>
 * @param string $formato <p>El formato con el que queremos la fecha de salida
 * </p>
 * @return date <p>La nueva Fecha</p>
 */
function incrementarFecha($fecha,$cantidad,$formato = "Y-m-d")
{
    $retorno = $fecha;
    
    $fechacomp = strtotime($fecha);
    $fechacomp= strtotime("+". $cantidad ." days", $fechacomp); //Le sumo n días
    $fechacomp = date($formato, $fechacomp);
    
    $retorno = $fechacomp;
    return $retorno;
}
/**
 * Obtiene la fecha actual con algun formato determinado
 * @param string $formato <p>parametro opcional, si se utiliza se formatea la 
 * fecha al formato solicitado, de no utilizarse la funcion toma por defecto
 * el formato aaaa-mm-dd</p>   
 * @return date La fecha solicitada 
 */
function diaDeHoy($formato = "")
{
    $retorno = "";
    
    if($formato == "")
    {
        $retorno = date("Y-m-d H:i:s");
    }
    else
    {
        $retorno = date($formato);  
    }    
    
    return $retorno;
}
/**
 * Dado un array de feriados y una fecha, determina si esa fecha
 * es un feriado
 * @param date $fecha <p>La fecha a determinar</p>
 * @param array $arrayFeriado <p>Array con feriados a comparar</p>
 * @return boolean <p><b>TRUE</b> si la fecha es feriado <br>
 * <b>FALSE</b> caso contrario</p>
 */
function esFeriado($fecha,$arrayFeriado)
{
    $retorno = false;
    
    foreach($arrayFeriado as $feriado)
    {
        if($fecha == $feriado)
        {
            $retorno = true;
            break;
        }
    }
    
    return $retorno;
}
/**
 * Calcula el proximo dia habil a partir de una fecha especificada
 * @param date $fechaInicio <p>La fecha a partir de la cual se calcula el 
 * proximo dia habil</p>
 * @param integer $cantidad <p>La cantidad de dias que se utilizaran como 
 * distancia para calcular la proxima fecha</p>
 * @param boolean $cuentaSabado <p>Flag que determina si el dia sabado
 * sera considerado habil o no</p>
 * @param array $arrayFeriado <p>Array con los feriados que se deben 
 * tener en cuenta, en formato <b>YYYY-MM-DD</b></p>
 * @return date <p>La fecha calculada en formato <b>YYYY-MM-DD</b></p>
 */
function proximoDiaHabil($fechaInicio,$cantidad = 0 , $cuentaSabado = false, $arrayFeriado = array())
{
    $retorno = $fechaInicio;
       
    $fecha = $fechaInicio;
    for($i = 0; $i < $cantidad; $i++)
    {
        //OBTENEMOS LA FECHA DEL DIA SIGUIENTE
        $fecha          = incrementarFecha($fecha,1);
        $nombreFecha    = date("D", strtotime($fecha));

        //SI ES DOMINGO, NO TOMO EN CUENTA EL DIA
        if ($nombreFecha == "Sun")
        {
            $i--;
        }
        else
        {
            if($cuentaSabado == true && $nombreFecha == "Sat")
            {
               $i--;
            }
            else
            {
                if(!empty($arrayFeriado))
                {
                    if(esFeriado($fecha, $arrayFeriado))
                    {
                        $i--;
                    }
                    else
                    {
                        $retorno = $fecha;
                    }    
                }
                else
                {
                    $retorno = $fecha;
                }
            }
        }
    }
    
    return $retorno;
}
//</editor-fold>

//<editor-fold defaultstate="collapsed" desc="TIEMPOS">
/**
 * Toma una hora y le cambia el formato.<br>
 * Para hacer esto, la hora <b>debe venir en un formato valido</b>
 * @param time $hora <p>La hora a formatear</p>
 * @param string $formato <p>Cadena con el formato nuevo</p>
 * @return time <p>La hora formateada con el formato deseado</p>
 */
function formatearHora($hora,$formato = "H:i")
{
    $retorno;
    
    $retorno = date($formato,strtotime($hora));
    
    return $retorno;
}
/**
 * Obtiene la diferencia de tiempo entre dos horas
 * El formato de salida es hh:mm
 * @param String $horaMay
 * @param String $horaMen
 * @return Hour La diferencia de horas  
 */
function restarHoras($horaMay, $horaMen)
{
    return (date("H:i", strtotime("00:00") + strtotime($horaMay) - strtotime($horaMen) ));
}
/**
 * Obtiene la suma de tiempo entre dos horas
 * El formato de salida es hh:mm
 * @param String $unaHora
 * @param String $otraHora
 * @return Hour La Suma de horas  
 */
function sumarHoras($unaHora, $otraHora)
{
    $unaHora    = strtotime($unaHora);
    $otraHora   = strtotime($otraHora);
    $otraHora   = date("H",$otraHora);
    $unaHora    = strtotime("+".$otraHora ." hours",$unaHora);
    $unaHora    = date("H:i",$unaHora);
    
    return $unaHora;
}
/**
 * Toma una hora y le suma una x cantidad de minutos
 * El resultado se devuelve con el formtao hh:mm
 * @param String $unaHora
 * @param Int $minutos
 * @return String La hora resultante 
 */
function sumarMinutos($unaHora, $minutos)
{
    $unaHora = strtotime($unaHora);
    $unaHora = strtotime("+".$minutos." minutes",$unaHora);
    $unaHora = date("H:i",$unaHora);
    return $unaHora;
}
/**
 * Devuelve la parte float del resultado de microtime()
 * <br>Realiza un explode del valor total de microtime() y se queda
 * con la parte numerica
 * @return float <p>Los segundos del microtime() expresados en formato 
 * numerico</p>
 */
function microtimeFloat()
{
    $segundos = explode(" ", microtime());
    $segundos = $segundos[1];
    return $segundos;
}
/**
 * Realiza la resta de una cantidad "X" de tiempo a un valor inicial<br>
 * El valor inicial puede ser una fecha completa, o una cantidad de tiempo, pero
 * debe venir en un formato valido<br>
 * <b>Respetar el estandard de PHP</b>
 * @param time $valorInicial <p>El valor al cual se le realizara la resta</p>
 * @param integer $tiempo <p>El valor de tiempo que se le restara al valor inicial</p>
 * @param string $unidad <p>La unidad  de tiempo que se le restara al valor inicial. 
 * Este parametro debe estar en ingles, respetando el estandard de PHP<br>
 * Ej: second</p>
 * @param string $formatoFinal <p>El formato en el cual quiero que quede el valor
 * final. Este formato debe ser un formato valido, respetando el estandard de PHP</p>
 * @return date <p>El restultado de la operacion en el formato deseado</p>
 */
function restarTiempo($valorInicial,$tiempo,$unidad = "second",$formatoFinal = "i:s")
{
    /*$valorInicial = date("00:10:00"); // Fecha Actual

    $valorFinal = strtotime("-". $time ." second",strtotime($valorInicial));
    $valorFinal = date("i:s",$valorFinal);*/
    
    $temp       = strtotime("-".$tiempo." ".$unidad,strtotime($valorInicial));
    $retorno    = date($formatoFinal,$temp);
       
    return $retorno;
    
}
/**
 * Realiza la suma de una cantidad "X" de tiempo a un valor inicial<br>
 * El valor inicial puede ser una fecha completa, o una cantidad de tiempo, pero
 * debe venir en un formato valido<br>
 * <b>Respetar el estandard de PHP</b>
 * @param time $valorInicial <p>El valor al cual se le realizara la suma</p>
 * @param integer $tiempo <p>El valor de tiempo que se le sumara al valor inicial</p>
 * @param string $unidad <p>La unidad  de tiempo que se le sumara al valor inicial. 
 * Este parametro debe estar en ingles, respetando el estandard de PHP<br>
 * Ej: second</p>
 * @param string $formatoFinal <p>El formato en el cual quiero que quede el valor
 * final. Este formato debe ser un formato valido, respetando el estandard de PHP</p>
 * @return date <p>El restultado de la operacion en el formato deseado</p>
 */
function sumarTiempo($valorInicial,$tiempo,$unidad = "second",$formatoFinal = "i:s")
{
    
    $temp       = strtotime("+".$tiempo." ".$unidad,strtotime($valorInicial));
    $retorno    = date($formatoFinal,$temp);
       
    return $retorno;
    
}
//</editor-fold>




?>
