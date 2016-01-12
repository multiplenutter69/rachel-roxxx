<?php
/**
 * Nombre           : select.php                                                         
 * Autor            : Stefan
 * Version          :                                                         
 * Descripcion      : Genera HTML dinamicos utilizando PHP para los selects
 *                  : (select) de un proyecto                                                      
 * Fecha            :                                                          
 * Observaciones    :     
 */

/**
 * Genera el HTML de los option de un Select<br>
 * Se deben respetar los formatos de los datos de entrada para que funcione
 * @param array $datos <p>Array con las siguientes claves:<br><br>
 * datos : Array (2 dimensiones) con los datos a mostrar en el select <br>
 * datos => valor : El valor que se utilizara en el tag value<br>
 * datos => nombre : El nombre que se mostrara en el select
 * </p>
 * @param type $seleccionado <p>El valor que se desea dejar seleccionado en 
 * el select</p>
 * @return string <p>HTML de los options creados</p>
 */
function generarOptionsSelect($datos,$seleccionado = 0)
{
    $retorno = "";
    
    foreach($datos["datos"] as $d)
    {
        if($d["valor"] == $seleccionado)
        {
            $retorno .= "<option value=". $d["valor"] ." selected>". $d["nombre"] ."</option>";            
        }
        else
        {
            $retorno .= "<option value=". $d["valor"] .">". $d["nombre"] ."</option>";
        }
    }
    return $retorno;
    
}

