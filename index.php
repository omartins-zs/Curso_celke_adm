<?php
// Inicia a sessão
session_start();
// Limpa o Buffer de saida (Evita erros ao redirecionar)
ob_start();

//Carregar o Composer
require './vendor/autoload.php';

//Atribuir apelido "Home" para rota da classe "Core\ConfigController"
use Core\ConfigController as Home;

//Instanciar a classe utilizando o apelido "Home".
$url = new Home();

//Instanciar o método
$url->carregar();
