<?php

namespace App\adms\Models\helper;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * Description of AdmsSendEmail
 *
 * @author Gabriel Matheus
 */


class AdmsSendEmail
{
    private array $dados;
    private array $dadosInfoEmail;
    private array $resultadoBd;
    private bool $resultado;
    private string $fromEmail;
    private int $optionConfEmail;

    function getResultado(): bool
    {
        return $this->resultado;
    }

    function getFromEmail(): string
    {
        return $this->fromEmail;
    }

    public function sendEmail($dados, $optionConfEmail)
    {
        $this->optionConfEmail = $optionConfEmail;
        $this->dados = $dados;

        /*$this->dados['toEmail'] = "cesar1@celke.com.br";
        $this->dados['toName'] = "Cesar1";
        $this->dados['subject'] = "Confirmar e-mail";
        $this->dados['contentHtml'] = "Olá <b>Cesar</b><br><p>Cadastro realizado com sucesso!</p>";
        $this->dados['contentText'] = "Olá Cesar \n\nCadastro realizado com sucesso!\n";*/

        $this->infoPhpMailer();
        $this->sendEmailPhpMailer();
    }

    private function infoPhpMailer()
    {
        $confEmail = new \App\adms\Models\helper\AdmsRead();
        $confEmail->fullRead("SELECT name, email, host, username, password, smtpsecure, port FROM adms_confs_emails WHERE id =:id LIMIT :limit", "id={$this->optionConfEmail}&limit=1");
        $this->resultadoBd = $confEmail->getResult();
        var_dump($this->resultadoBd);

        $this->dadosInfoEmail['host'] = $this->resultadoBd[0]['host'];
        $this->dadosInfoEmail['fromEmail'] = $this->resultadoBd[0]['email'];
        $this->fromEmail = $this->dadosInfoEmail['fromEmail'];
        $this->dadosInfoEmail['fromName'] = $this->resultadoBd[0]['name'];
        $this->dadosInfoEmail['username'] = $this->resultadoBd[0]['username'];
        $this->dadosInfoEmail['password'] = $this->resultadoBd[0]['password'];
        $this->dadosInfoEmail['smtpsecure'] = $this->resultadoBd[0]['smtpsecure'];
        $this->dadosInfoEmail['port'] = $this->resultadoBd[0]['port'];
    }

    public function sendEmailPhpMailer()
    {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->CharSet = 'UTF-8';
            //  $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = $this->dadosInfoEmail['host'];          //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $this->dadosInfoEmail['username'];      //SMTP username
            $mail->Password   = $this->dadosInfoEmail['password'];      //SMTP password
            $mail->SMTPSecure =  $this->dadosInfoEmail['smtpsecure'];         //Enable implicit TLS encryption
            $mail->Port       = $this->dadosInfoEmail['port'];                                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($this->dadosInfoEmail['fromEmail'], $this->dadosInfoEmail['fromName']);
            $mail->addAddress($this->dados['toEmail'], $this->dados['toName']);     //Add a recipient

            $mail->isHTML(true);
            $mail->Subject = $this->dados['subject'];
            $mail->Body = $this->dados['contentHtml'];
            $mail->AltBody = $this->dados['contentText'];

            $mail->send();
            echo 'E-mail enviado com sucesso!!!';
            $this->resultado = true;
        } catch (Exception $ex) {
            echo "Erro: E-mail não foi enviado com sucesso!! Mailer Error: {$mail->ErrorInfo}";
            $this->resultado = false;
        }
    }
}
