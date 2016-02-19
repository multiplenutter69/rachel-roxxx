<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>New User Added</h1>
        
        <?php 
            echo $user->getUser() . "<hr>";
            echo $user->getPassword() . "<hr>";
        ?>
        
    </body>
</html>
