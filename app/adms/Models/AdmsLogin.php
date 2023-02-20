<?php

namespace App\adms\Models;

/**
 * Description of AdmsLogin
 *
 * @author Gabriel Matheus
 */
class AdmsLogin extends helper\AdmsConn
{
    private array $dados;
    private object $conn;

    public function login(array $dados = null)
    {
        $this->dados = $dados;
        var_dump($this->dados);
        $this->conn = $this->connect();
    }
}
