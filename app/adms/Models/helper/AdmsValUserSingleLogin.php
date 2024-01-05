<?php

namespace App\adms\Models\helper;

/**
 * Description of AdmsValUserSingleLogin
 *
 * @author Gabriel Matheus
 */
class AdmsValUserSingleLogin
{

    private string $userName;
    private bool $resultado;
    private $resultadoBd;

    function getResultado(): bool
    {
        return $this->resultado;
    }

    public function validarUserSingleLogin($username)
    {
        $this->userName = $username;

        $valUserSingleLogin = new \App\adms\Models\helper\AdmsRead();
        $valUserSingleLogin->fullRead("SELECT id FROM adms_users WHERE username =:username LIMIT :limit", "username={$this->userName}&limit=1");

        $this->resultadoBd = $valUserSingleLogin->getResult();
        if (!$this->resultadoBd) {
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "Erro: Este e-mail já está cadastrado!";
            $this->resultado = false;
        }
    }
}
