<?php

namespace App\adms\Models;

/**
 * Description of AdmsNewUser
 *
 * @author Gabriel Matheus
 */
class AdmsNewUser
{

    private array $dados;
    private bool $resultado;

    function getResultado()
    {
        return $this->resultado;
    }

    public function create(array $dados = null)
    {
        $this->dados = $dados;
        $valCampoVazio = new \App\adms\Models\helper\AdmsValCampoVazio();
        $valCampoVazio->validarDados($this->dados);
        if ($valCampoVazio->getResultado()) {
            $this->valInput();
        } else {
            $this->resultado = false;
        }
    }

    private function valInput()
    {
        $valEmail = new \App\adms\Models\helper\AdmsValEmail();
        $valEmail->validarEmail($this->dados['email']);

        $valEmailSingle = new \App\adms\Models\helper\AdmsValEmailSingle();
        $valEmailSingle->validarEmailSingle($this->dados['email']);

        if ($valEmail->getResultado() and $valEmailSingle->getResultado()) {
            $_SESSION['msg'] = "Usuário deve ser cadastrado!";
            $this->resultado = false;
            //$this->add();
        } else {
            $this->resultado = false;
        }
    }

    private function add()
    {
        $this->dados['password'] = password_hash($this->dados['password'], PASSWORD_DEFAULT);
        $this->dados['user'] = $this->dados['email'];
        $this->dados['created'] = date("Y-m-d H:i:s");
        $createUser = new \App\adms\Models\helper\AdmsCreate();
        $createUser->exeCreate("adms_users", $this->dados);

        if ($createUser->getResult()) {
            $_SESSION['msg'] = "Erro: Usuário cadastrado com sucesso!";
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "Erro: Usuário não cadastrado com sucesso!";
            $this->resultado = false;
        }
    }
}
