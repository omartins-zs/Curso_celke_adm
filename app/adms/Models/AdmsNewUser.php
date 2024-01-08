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
    private string $firstName;
    private array $emailData;

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
        $this->emailHtml();
        $this->emailText();
        $sendEmail->sendEmail($this->emailData, 2);
        if ($sendEmail->getResultado()) {
            $_SESSION['msg'] = "Usuário cadastrado com sucesso. Acesse a sua caixa de e-mail para confimar o e-mail!";
            $this->resultado = false;
        } else {
            $this->fromEmail = $sendEmail->getFromEmail();
            $_SESSION['msg'] = "Usuário cadastrado com sucesso. Houve erro ao enviar o e-mail de confirmação, entre em contado com " . $this->fromEmail . " para mais informações!";
            $this->resultado = false;
        }
    }

    private function emailHtml()
    {
        $name = explode(" ", $this->dados['name']);
        $this->firstName = $name[0];

        $this->emailData['toEmail'] = $this->dados['email'];
        $this->emailData['toName'] = $this->firstName;
        $this->emailData['subject'] = "Confirmar sua conta";

        /*$this->emailData['contentHtml'] = "Prezado(a) {$this->firstName}<br><br>";
        $this->emailData['contentHtml'] .= "Agradecemos a sua solicitação de cadastramento em nosso site!<br><br>";
        $this->emailData['contentHtml'] .= "Para que possamos liberar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo: <br><br>";
        $this->emailData['contentHtml'] .= "LINK<br><br>";
        $this->emailData['contentHtml'] .= "Esta mensagem foi enviada a você pela empresa XXX.<br>Você está recebendo porque está cadastrado no banco de dados da empresa XXX. Nenhum e-mail enviado pela empresa XXX tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.<br><br>";   */


        $this->emailData['contentHtml'] = "Falta só mais um passo...<br><br>";
        $this->emailData['contentHtml'] .= "Oi, {$this->firstName}.<br><br>";
        $this->emailData['contentHtml'] .= "Só falta mais um passo para você acessar o conteúdo completo da empresa XXX.<br><br>";
        $this->emailData['contentHtml'] .= "Clique abaixo para confirmar seu e-mail.<br><br>";
        $this->emailData['contentHtml'] .= "LINK<br><br>";
        $this->emailData['contentHtml'] .= "Esta mensagem foi enviada a você pela empresa XXX. <br>Você está recebendo porque está cadastrado no banco de dados da empresa XXX. Nenhum e-mail enviado pela empresa XXX tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.<br><br>";
    }

    private function emailText()
    {
        $this->emailData['contentText'] = "Prezado(a) {$this->firstName}\n\n";
        $this->emailData['contentText'] .= "Agradecemos a sua solicitação de cadastramento em nosso site!\n\n";
        $this->emailData['contentText'] .= "Para que possamos liberar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo: \n\n";
        $this->emailData['contentText'] .= "LINK\n\n";
        $this->emailData['contentText'] .= "Esta mensagem foi enviada a você pela empresa XXX.\nVocê está recebendo porque está cadastrado no banco de dados da empresa XXX. Nenhum e-mail enviado pela empresa XXX tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.\n\n";
    }
}
