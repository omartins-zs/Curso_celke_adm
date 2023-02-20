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
        $carregarView = new \Core\ConfigView("adms/Views/dashboard/home");
        $carregarView->renderizar();
    }
}
