<?php

namespace App\adms\Models\helper;

/**
 * Description of AdmsValCampoVazio
 *
 * @author Gabriel Matheus
 */
class AdmsValCampoVazio
{
    
    private array $dados;
    private bool $resultado;

    function getResultado(): bool {
        return $this->resultado;
    }
    
    public function validarDados(array $dados) {
        $this->dados = $dados;
        $this->dados = array_map('strip_tags', $this->dados);
        $this->dados = array_map('trim', $this->dados);
        
        if(in_array('', $this->dados)){
            $_SESSION['msg'] = "Erro: Necessário preencher todos os campos!";
            $this->resultado = false;
        }else{
            $this->resultado = true;
        }
    }
}
