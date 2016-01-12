<?php

/**
 * Nombre           : gestionMail.php                                                          
 * Autor            : Desconocido
 * Version          : 1.0                                                        
 * Descripcion      : En este archivo se alojaran todas las funciones necesarias                                                         
 *                  : para realizar                                                          
 * Fecha            :                                                          
 * Observaciones    :     
 */

require_once("class.phpmailer.php"); 

function enviarEmail($origen,
                     $nombreOrigen,
                     $destino,
                     $tituloEmail,
                     $cuerpoEmail,
                     $servidor,
                     $usuario,
                     $contraseña,
                     $seguridadSMTP,
                     $puerto)
{  
    //Especificamos la utilización de la librería PHPMailer 5.2.1 contenida en el directorio actual
    //require_once('class.phpmailer.php'); 
    
    $retorno = false;
    
    //El parámetro 'true' significa que lanzará excepciones en los errores que se produzcan, las cuales deben ser capturadas
    $mail = new PHPMailer(true); 
 
    //Le decimos a la clase que utilice SMTP
    $mail->IsSMTP(); 
 
    try 
    {
        $mail->SMTPDebug  = 0;                    // Activa la información SMTP de depuración (para pruebas)
        $mail->SMTPAuth   = true;                 // Activa autenficicación SMTP
        $mail->SMTPSecure = $seguridadSMTP;       // Especifica la seguridad SMTP
        $mail->Host       = $servidor;            // Especificamos la dirección del servidor de correo 
        $mail->Port       = $puerto;              // Puerto del servidor de correo
        $mail->Username   = $usuario;             // Usuario del correo origen
        $mail->Password   = $contraseña;          // Contraseña del correo origen

        $mail->AddAddress($destino, '');          // Dirección de correo destino
        $mail->SetFrom($origen, $nombreOrigen);   // Especificamos el origen del correo
        $mail->Subject = $tituloEmail;            // Titulo del email
        $mail->MsgHTML($cuerpoEmail);             // Cuerpo del email


        //Recorremos vector de rutas de archivos y adjuntamos
        /*for($i = 0; $i < count($archivosAdjuntos); $i++) 
        {
            $mail->AddAttachment($archivosAdjuntos[$i]);
        }*/

        $mail->Send();
        
        $retorno = true;
      
    } 
    catch (phpmailerException $e) 
    {
        //Excepción de PHPMailer
        //logError($e->errorMessage());
        $retorno = false;
    } 
    catch (Exception $e) 
    {
        //Cualquier otra excepción
        //logError($e->getMessage()); 
        $retorno = false;
    }
    
    return $retorno;
}


?>
