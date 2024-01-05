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
    private bool $resultado;
    private string $fromEmail;

    function getResultado(): bool
    {
        return $this->resultado;
    }

    function getFromEmail(): string
    {
        return $this->fromEmail;
    }

    public function sendEmail()
    {
        $this->dadosInfoEmail['host'] = "sandbox.smtp.mailtrap.io";
        $this->dadosInfoEmail['fromEmail'] = "gabrielmartinsdev@gmail.com";
        $this->fromEmail = $this->dadosInfoEmail['fromEmail'];
        $this->dadosInfoEmail['fromName'] = "Gabriel Matheus";
        $this->dadosInfoEmail['username'] = "ce91d1bb4f2385";
        $this->dadosInfoEmail['password'] = "4cc7bcea90647a";
        // $this->dadosInfoEmail['port'] =587;

        $this->dados['toEmail'] = "jaquelinesensacao@gmail.com";
        $this->dados['toName'] = "Lucas Guimaraes";
        $this->dados['subject'] = "Confirmar E-mail";
        $this->dados['contentHtml'] = "Olá <b>Lucas</b><br><p>Cadastro realizado com sucesso!</p>";
        $this->dados['contentText'] = "Olá Lucas \n\nCadastro realizado com sucesso!\n";

        $this->sendEmailPhpMailer();
    }

    public function sendEmailPhpMailer()
    {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->CharSet = 'UTF-8';
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = $this->dadosInfoEmail['host'];          //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $this->dadosInfoEmail['username'];      //SMTP username
            $mail->Password   = $this->dadosInfoEmail['password'];      //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

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
