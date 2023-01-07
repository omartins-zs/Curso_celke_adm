<?php

namespace App\adms\Models;

/**
 * Description of AdmsLogin
 *
 * @author Gabriel Matheus
 */
class AdmsLogin
{
    private array $dados;


    public function login(array $dados = null) {
        $this->dados = $dados;
        var_dump($this->dados);
    }
}
