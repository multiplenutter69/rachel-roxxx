<?php require_once ("../config/config.php"); ?>

<html>
<head>
    <meta charset='UTF-8' content='1' http-equiv='REFRESH'></meta>
    <title>Sesion Debuger</title>
</head>

<?php
    if($_debug_mode == DEBUG)
    {
        $html = "<body><h1>Session Values</h1><hr>"; 

        session_start();
        while(list($clave,$valor) = each($_SESSION))
        {
            $html .= $clave.": ".$valor."<hr>";
        }

        reset($_SESSION);

        $html .= "</body>";

    }
    else
    {
        $html = "<h1>Acceso Denegado!</h1><p>Usted no tiene permitido el acceso a esta seccion</p>";
    }
    
    echo $html;
?>
</html>



