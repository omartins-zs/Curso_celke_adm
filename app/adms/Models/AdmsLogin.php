<?php

namespace App\adms\Models;

use PDO;

/**
 * Description of AdmsLogin
 *
 * @author Gabriel Matheus
 */
class AdmsLogin extends helper\AdmsConn
{
    private array $dados;
    private object $conn;
    private $resultadoBd;
    private bool $resultado;

    function getResultado()
    {
        return $this->resultado;
    }

    public function login(array $dados = null)
    {
        $this->dados = $dados;

        $viewUser = new \App\adms\Models\helper\AdmsRead();
        //$viewUser->exeRead("adms_users", "WHERE user =:user LIMIT :limit", "user={$this->dados['user']}&limit=1");
        $viewUser->fullRead(
            "SELECT id, name, nickname, email, password, image
                FROM adms_users
                WHERE username =:username OR
                email =:email
                LIMIT :limit",
            "username={$this->dados['username']}&email={$this->dados['username']}&limit=1"
        );

        $this->resultadoBd = $viewUser->getResult();
        if ($this->resultadoBd) {
            $this->validarSenha();
        } else {
            $_SESSION['msg'] = "Erro: Usuário não encontrado!<br><br>";
            $this->resultado = false;
        }
    }

    private function validarSenha()
    {
        if (password_verify($this->dados['password'], $this->resultadoBd[0]['password'])) {
            $_SESSION['user_id'] = $this->resultadoBd[0]['id'];
            $_SESSION['user_name'] = $this->resultadoBd[0]['name'];
            $_SESSION['user_nickname'] = $this->resultadoBd[0]['nickname'];
            $_SESSION['user_image'] = $this->resultadoBd[0]['image'];
            $_SESSION['user_email'] = $this->resultadoBd[0]['email'];
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "Erro: Usuário ou senha incorreta! <br><br>";
            $this->resultado = false;
        }
    }
}
