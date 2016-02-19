<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title; ?></title>
    </head>
    <body>
        <h1>Success!!</h1>
        
        <table>
            <caption><?php $tableCaption?></caption>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Edad</th>
            </tr>
            <?php 
            foreach($data as $d){
                echo "<tr>";
                echo "<td>". $d["nombre"] ."</td>";
                echo "<td>". $d["apellido"] ."</td>";
                echo "<td>". $d["edad"] ."</td>";
                echo "</tr>";
            } 
            
            ?>
        </table>
        
    </body>
</html>
