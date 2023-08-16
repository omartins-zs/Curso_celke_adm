<?php

namespace App\adms\Models\helper;

/**
 * Description of AdmsValEmailSingle
 *
 * @author Gabriel Matheus
 */
class AdmsValEmailSingle
{

    private string $email;
    private $edit;
    private $id;
    private bool $resultado;
    private $resultadoBd;

    function getResultado(): bool
    {
        return $this->resultado;
    }

    public function validarEmailSingle($email, $edit = null, $id = null)
    {
        $this->email = $email;
        $this->edit = $edit;
        $this->id = $id;

        $valEmailSingle = new \App\adms\Models\helper\AdmsRead();
        if (($this->edit == true) and (!empty($this->id))) {
            $valEmailSingle->fullRead("SELECT id FROM adms_users WHERE email =:email AND id <>:id LIMIT :limit", "email={$this->email}&id={$this->id}&limit=1");
        } else {
            $valEmailSingle->fullRead("SELECT id FROM adms_users WHERE email =:email LIMIT :limit", "email={$this->email}&limit=1");
        }

        $this->resultadoBd = $valEmailSingle->getResult();
        if (!$this->resultadoBd) {
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "Erro: Este e-mail já está cadastrado!";
            $this->resultado = false;
        }
    }
}
