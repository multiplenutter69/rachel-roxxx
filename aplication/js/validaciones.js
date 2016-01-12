/**
 * Nombre           : validaciones.js
 * Autor            : Stefan
 * Fecha            :
 * Descripcion      : Archivo encargado de alojar las validaciones realizadas 
 *                  : por js a los formularios
 * Observaciones    :
 */

$(document).ready(function () {
    $("#frmEjemplo").validate({
        rules:
                {
                    nombre: {required: true, maxlength: 255}
                },
        messages:
                {
                    nombre: {required: "Este Campo es obligatorio", maxlength: "La longitud maxima es de 255 caracteres"}
                    
                },
        errorElement: "div"
    });
});

