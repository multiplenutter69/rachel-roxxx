<?php
/**
 * Nombre           : gui_ejemplo.php                                                         
 * Autor            : Stefan
 * Version          :                                                         
 * Descripcion      : Genera HTML dinamico utilizando PHP                                                        
 * Fecha            :                                                          
 * Observaciones    :     
 */

require_once($_base. "/sistema/gui/tabla.php");
require_once($_base. "/sistema/gui/select.php");

function generarTablaEjemplo($datos)
{
    $retorno = "<table>
                <caption>Tabla Ejemplo</caption>
                <thead>
                    <tr>
                        <th>
                            Columna 1
                        </th>
                        <th>
                            Columna 2
                        </th>
                        <th>
                            Columna 3
                        </th>
                        <th>
                            Columna 4
                        </th>
                    </tr>
                </thead>";
    
    $productos = $datos["datos"];
    foreach($productos as $c)
    {
        $retorno .= "   <tr>
                            <td>
                                " . $c["columna_1"] . "
                            </td>
                            <td>
                                " . $c["columna_2"] . "
                            </td>
                            <td>
                                " . $c["columna_3"] . "
                            </td>
                            <td>
                                " . $c["columna_4"] . "
                            </td>
                        </tr>";
    }
    
    $retorno .= generarFooterTabla($datos);
    
    $retorno .= "</table>";
    
    return $retorno;
}

function generarComboEjemplo($datos,$seleccionado = 0)
{
    $retorno = "<select>" ;
    $retorno .= generarOptionsSelect($datos, $seleccionado);
    $retorno .= "</select>";
    
    return $retorno;
}
