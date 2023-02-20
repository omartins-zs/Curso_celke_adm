<?php

namespace App\adms\Models;

use PDO;

/**
 * Description of AdmsLogin
 *
 * @author Gabriel Matheus
 */
class AdmsNewUser extends helper\AdmsConn
{
    private array $dados;
    private object $conn;
    private $resultadoBd;
    private bool $resultado;

    function getResultado()
    {
        return $this->resultado;
    }

    public function create(array $dados = null)
    {
        $this->dados = $dados;
        var_dump($this->dados);
        
        $this->dados['password'] = password_hash($this->dados['password'], PASSWORD_DEFAULT);
        $this->conn = $this->connect();

        $query_new_user = "INSERT INTO adms_users (name, email, user, password, created) VALUES ( :name, :email, :user, :password, NOW())";
        $add_new_user = $this->conn->prepare($query_new_user);
        $add_new_user->bindParam(':name', $this->dados['name']);
        $add_new_user->bindParam(':email', $this->dados['email']);
        $add_new_user->bindParam(':user', $this->dados['email']);
        $add_new_user->bindParam(':password', $this->dados['password']);

        $add_new_user->execute();
        if ($add_new_user->rowCount()) {
            $_SESSION['msg'] = "Erro: Usuário cadastrado com sucesso!";
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "Erro: Usuário não cadastrado com sucesso!";
            $this->resultado = false;
        }
    }
}
