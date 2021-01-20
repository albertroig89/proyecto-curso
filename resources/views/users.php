<!doctype html>
<html lang"en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Listado de usuarios - Curs</title>
        
    </head>
    <body>
        <h1>Usuarios</h1>
        
        <ul>
            
            <?php foreach ($users as $user): ?>
                <li><?php echo e($user) ?></li> <!--e($user) el que fa es ometre la lectura si algu ens coloca codic de html o javascript aon tindria que anar el nom d'usuari-->
            <?php endforeach; ?>
            
        </ul>
        
    </body>
    
</html>