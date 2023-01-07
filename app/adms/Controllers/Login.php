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
    private $dadosForm;

    public function access() {

        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dadosForm['SendLogin'])) {
            var_dump($this->dadosForm);
            $this->dados['form'] = $this->dadosForm;
        }
        //$this->dados = [];
        $carregarView = new \Core\ConfigView("adms/Views/login/access", $this->dados);
        $carregarView->renderizar();
    }
}
