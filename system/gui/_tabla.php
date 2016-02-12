<?php
/**
 * Nombre           : tabla.php                                                         
 * Autor            : Stefan
 * Version          :                                                         
 * Descripcion      : Genera HTML dinamicos utilizando PHP para las tablas 
 *                  : (table) de un proyecto                                                      
 * Fecha            :                                                          
 * Observaciones    :     
 */

/**
 * Genera el HTML del footer de una table con paginacion incluida<br>
 * Se deben respetar los formatos de los datos de entrada para que funcione
 * @param array $datos <p>Array con los datos necesarios para la paginacion. 
 * Debe Contener las siguientes claves:<br><br>
 * pagina : La pagina actual<br>
 * q : El contenido del campo busqueda (si existe)<br>
 * totalPaginas : La cantidad total de paginas a mostrar<br>
 * totalColumnas : La cantidad de columnas que tiene la tabla<br>
 * vistaActual : La vista a la que se debe redireccionar cuando se pase de pagina
 * o se re direccione a una pagina en especial. Ej: admin/usuario
 * </p>
 * @return string HTML con el footer de la tabla
 */
function generarFooterTabla($datos)
{
    $retorno = "<tfoot>";  
    
    if ($datos["totalPaginas"] > 1)
    { 
        $retorno .= "<tr>";
        $retorno .= "<td colspan = '". $datos["totalColumnas"] ."' align = 'center'>";

        if($datos["pagina"] == 1)
        {
            $retorno .= "< |";
        }
        else
        {
            $retorno .= "<a href='". $datos["vistaActual"] ."/".($datos["pagina"] - 1);
            $retorno .= ($datos["q"] != "") ? "/".$datos["q"] : "";
            $retorno .= "'>< </a>|";
        }

        for ($i = 1; $i <= $datos["totalPaginas"]; $i++) 
        { 
            if ($datos["pagina"] == $i)
            {
                $retorno .= $datos["pagina"]."|";
            }
            else
            {
                $retorno .= "<a href='". $datos["vistaActual"] ."/".$i;
                $retorno .= ($datos["q"] != "") ? "/".$datos["q"] : "";
                $retorno .= "'>".$i."</a>|";
            }
        } 

        if($datos["pagina"] == $datos["totalPaginas"])
        {
            $retorno .= " >";
        }
        else
        {
            $retorno .= "<a href='". $datos["vistaActual"] ."/".($datos["pagina"] + 1);
            $retorno .= ($datos["q"] != "") ? "/".$datos["q"] : "";
            $retorno .= "'> ></a>";
        }
        $retorno .= "</td>";
        $retorno .= "</tr>";
    }
    $retorno .= "</tfoot>";
    
    return $retorno;
}


