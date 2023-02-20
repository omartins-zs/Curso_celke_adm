<?php
// Inicia a sessão
session_start();
// Limpa o Buffer de saida (Evita erros ao redirecionar)
ob_start();

require './vendor/autoload.php';

use Core\ConfigController as Home;

$url = new Home();
$url->carregar();
