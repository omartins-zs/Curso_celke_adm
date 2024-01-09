<?php

namespace App\adms\Models;

/**
 * Description of AdmsNewConfEmail
 *
 * @author Gabriel Matheus
 */
class AdmsNewConfEmail extends helper\AdmsConn
{

    private array $dados;
    private $resultadoBd;
    private bool $resultado;
    private string $firstName;
    private array $emailData;

    function getResultado() {
        return $this->resultado;
    }

    public function newConfEmail(array $dados = null) {
      
    }

   
}
