<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Celke</title>
</head>

<body>
    <?php
    require './vendor/autoload.php';

    use Core\ConfigController as Home;

    $url = new Home();
    $url->carregar();
    ?>
</body>

</html>