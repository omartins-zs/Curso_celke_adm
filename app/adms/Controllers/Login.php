<?php

namespace App\adms\Controllers;
/**
 * Description of Login
 *
 * @author Gabriel Matheus
 */
class Login
{
    private $dados;
    
    public function access() {
        
        $this->dados = [];
        
        $carregarView = new \Core\ConfigView("adms/Views/login/access", $this->dados);
        $carregarView->renderizar();
    }
}
