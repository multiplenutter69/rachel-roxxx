/*
 * Nombre           : ajax.js                                                  
 * Autor            : Stefan                                           
 * Descripcion      : En este archivo se alojan todas las funciones JS         
 *                  : que realizan pedidos tipo AJAX                           
 * Fecha            :                                             
 * Observaciones    : Todos los pedidos, se realizan a traves de JQuery                                                         *
 */


function eliminarEjemplo(param)
{
    var parametros = {"param" : param};
    
    $.ajax({
                data    :   parametros,
                url     :   'aplicacion/scripts/ejemplo/ejemplo.php',
                type    :   'POST',

                //MIENTRAS CARGA
                beforeSend: function () 
                {
                    var htmlWait = "<br><br><span><b>Procesando pedido...</b></span>";
                    $("#myDiv").html(htmlWait);
                },

                //EL RESULTADO DEL AJAX
                success:  function (response) 
                {
                    $("#myDiv").html(response);
                }

            });
}

