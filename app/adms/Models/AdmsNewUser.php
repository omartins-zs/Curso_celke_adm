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
    private string $fromEmail;

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

        $valPassword = new \App\adms\Models\helper\AdmsValPassword();
        $valPassword->validarPassword($this->dados['password']);

        $valUserSingleLogin = new \App\adms\Models\helper\AdmsValUserSingleLogin();
        $valUserSingleLogin->validarUserSingleLogin($this->dados['email']);

        if ($valEmail->getResultado() and $valEmailSingle->getResultado() and $valPassword->getResultado() and $valUserSingleLogin->getResultado()) {
            //$_SESSION['msg'] = "Usuário deve ser cadastrado!";
            //$this->resultado = false;
            $this->add();
        } else {
            $this->resultado = false;
        }
    }

    private function add()
    {
        $this->dados['password'] = password_hash($this->dados['password'], PASSWORD_DEFAULT);
        $this->dados['username'] = $this->dados['email'];
        $this->dados['created'] = date("Y-m-d H:i:s");
        $createUser = new \App\adms\Models\helper\AdmsCreate();
        $createUser->exeCreate("adms_users", $this->dados);

        if ($createUser->getResult()) {
            //$_SESSION['msg'] = "Usuário cadastrado com sucesso!";
            //$this->resultado = true;
            $this->sendEmail();
        } else {
            $_SESSION['msg'] = "Erro: Usuário não cadastrado com sucesso!";
            $this->resultado = false;
        }
    }

    private function sendEmail()
    {
        $sendEmail = new \App\adms\Models\helper\AdmsSendEmail();
        $sendEmail->sendEmail(2);
        if ($sendEmail->getResultado()) {
            $_SESSION['msg'] = "Usuário cadastrado com sucesso. Acesse a sua caixa de e-mail para confimar o e-mail!";
            $this->resultado = false;
        } else {
            $this->fromEmail = $sendEmail->getFromEmail();
            $_SESSION['msg'] = "Usuário cadastrado com sucesso. Houve erro ao enviar o e-mail de confirmação, entre em contado com " . $this->fromEmail . " para mais informações!";
            $this->resultado = false;
        }
    }
}
