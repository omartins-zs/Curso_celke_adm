<?php

namespace Core;

/**
 * Description of ConfigView
 *
 * @author Gabriel Matheus
 */
class ConfigView
{

    private string $nome;
    private $dados;

    public function __construct($nome, array $dados = null) {
        $this->nome = $nome;
        $this->dados = $dados;
    }

    public function renderizar() {
        if (file_exists('app/' . $this->nome . '.php')) {
            include 'app/adms/Views/include/header.php';
            include 'app/' . $this->nome . '.php';
            include 'app/adms/Views/include/footer.php';
        } else {
            // Apenas em desenvolivmento no Oficial comentar "echo" e deixar o "die"
            //die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM . "!<br>");
            echo "Erro ao carregar view: {$this->nome}<br>";
        }
    }

}
