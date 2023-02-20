<?php

namespace App\adms\Controllers;

/**
 * Description of Dashboard
 *
 * @author Gabriel Matheus
 */
class Dashboard
{
    // private $dados;
    // private $dadosForm;

    public function index()
    {
        echo "Bem vindo ao Dashboard ". $_SESSION['user_name'] . "<br>";
    }
}
