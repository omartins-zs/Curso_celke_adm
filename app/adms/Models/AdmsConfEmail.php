<?php

namespace App\adms\Models;

/**
 * Description of AdmsConfEmail
 *
 * @author Gabriel Matheus
 */
class AdmsConfEmail extends helper\AdmsConn
{

    private $resultadoBd;
    private bool $resultado;
    private string $chave;

    function getResultado()
    {
        return $this->resultado;
    }

    public function confEmail($chave)
    {
        $this->chave = $chave;

        $viewChaveConfEmail = new \App\adms\Models\helper\AdmsRead();
        $viewChaveConfEmail->fullRead(
            "SELECT id
                FROM adms_users
                WHERE conf_email =:conf_email
                LIMIT :limit",
            "conf_email={$this->chave}&limit=1"
        );

        $this->resultadoBd = $viewChaveConfEmail->getResult();
        if ($this->resultadoBd) {
            $this->updateSitUser();
        } else {
            $_SESSION['msg'] = "Erro: Link inválido!<br>";
            $this->resultado = false;
        }
    }

    private function updateSitUser()
    {
        $conf_email = null;
        $adms_sits_user_id = 1;
        //http://localhost/celke/adm/conf-email/index?chave=$2y$10$9gTw5bjML2CoSSG0j3oHw.DWkCi0FhjtIhhYV93y8iWXDBpKKYJk.

        $query_ativar_user = "UPDATE adms_users SET conf_email=:conf_email, adms_sits_user_id=:adms_sits_user_id, modified = NOW() WHERE id=:id";
        $ativar_user = $this->connect()->prepare($query_ativar_user);
        $ativar_user->bindParam(':conf_email', $conf_email);
        $ativar_user->bindParam(':adms_sits_user_id', $adms_sits_user_id);
        $ativar_user->bindParam(':id', $this->resultadoBd[0]['id']);
        $ativar_user->execute();

        if ($ativar_user->rowCount()) {
            $_SESSION['msg'] = "E-mail ativado com sucesso!<br>";
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "Erro: Link inválido!<br>";
            $this->resultado = false;
        }
    }
}
