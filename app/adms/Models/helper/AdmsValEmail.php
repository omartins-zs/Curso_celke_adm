<?php

namespace App\adms\Models\helper;

/**
 * Description of AdmsValEmail
 *
 * @author Gabriel Matheus
 */
class AdmsValEmail
{

    private string $email;
    private bool $resultado;

    function getResultado(): bool
    {
        return $this->resultado;
    }

    public function validarEmail($email)
    {
        $this->email = $email;

        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "Erro: E-mail inválido!";
            $this->resultado = false;
        }
    }
}
