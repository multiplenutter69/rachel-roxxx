/**
 * Nombre           : confirm.js
 * Autor            : Stefan
 * Version          :                                                         
 * Descripcion      : Archivo Js donde se alojan todos las funciones que 
 *                  : muestran Modals de Cofirmacion en el proyecto
 * Fecha            :                                                          
 * Observaciones    :     
 */


function confirmEjemplo(param)
{
    $("#modalEliminar").fadeTo(200, 1).css('display', 'block');
    $("#cover").fadeTo(200, 0.5).css('display', 'block');
    
    $("#cover,#btnCancel").click(function (event) 
    {
        $("#modalEliminar").fadeOut(200);
        $("#cover").fadeOut(200);
    });
    
    $("#btnEliminar").one( "click" , function (event) 
    {
        eliminarEjemplo(param);
        $("#modalEliminar").fadeOut(200);
        $("#cover").fadeOut(200);
    });
}

