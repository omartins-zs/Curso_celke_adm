<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Celke</title>
    </head>
    <body>
        <?php
        require './core/ConfigController.php';
        
        $home = new ConfigController();
        $home->carregar();
        ?>
    </body>
</html>
