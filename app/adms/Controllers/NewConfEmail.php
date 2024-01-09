<?php

namespace App\adms\Controllers;

/**
 * Description of NewConfEmail
 *
 * @author Gabriel Matheus
 */
class NewConfEmail
{

    private $dados;
    private $dadosForm;

    public function index()
    {

        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dadosForm['NewConfEmail'])) {
            unset($this->dadosForm['NewConfEmail']);
            $newConfEmail = new \App\adms\Models\AdmsNewConfEmail();
            $newConfEmail->newConfEmail($this->dadosForm);
            if ($newConfEmail->getResultado()) {
                $urlDestino = URLADM . "login/index";
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dadosForm;
                $this->viewNewConfEmail();
            }
        } else {
            $this->viewNewConfEmail();
        }
    }

    private function viewNewConfEmail()
    {
        $carregarView = new \Core\ConfigView("adms/Views/login/newConfEmail", $this->dados);
        $carregarView->renderizar();
    }
}
