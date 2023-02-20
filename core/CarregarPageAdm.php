<?php

namespace Core;

/**
 * Description of CarregarPageAdm
 *
 * @author Gabriel Matheus
 */
class CarregarPageAdm
{
    private string $urlController;
    private string $urlMetodo;
    private string $urlParametro;
    private string $classe;

    public function carregarPg($urlController = null, $urlMetodo = null, $urlParametro = null)
    {
        $this->urlController = $urlController;
        $this->urlMetodo = $urlMetodo;
        $this->urlParametro = $urlParametro;

        $this->classe = "\\App\\adms\\Controllers\\" . $this->urlController;
        if (class_exists($this->classe)) {
            $this->carregarMetodo();
        } else {
            $this->urlController = $this->slugController(CONTROLLER);
            $this->urlMetodo = $this->slugMetodo(METODO);
            $this->urlParametro = "";
            $this->classe = "\\App\\adms\\Controllers\\" . $this->urlController;
            $this->carregarMetodo();
        }
    }

    private function carregarMetodo()
    {
        $classCarregar = new $this->classe();
        if (method_exists($classCarregar, $this->urlMetodo)) {
            $classCarregar->{$this->urlMetodo}();
        } else {
            die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM . "!<br>");
        }
    }

    private function slugController($slugController)
    {
        //Converter para minusculo
        $this->slugController = strtolower($slugController);
        //Converter o traço para espaço em braco
        $this->slugController = str_replace("-", " ", $this->slugController);
        //Converter a primeira letra de cada palavra para maiusculo
        $this->slugController = ucwords($this->slugController);
        //Retirar o espaço em braco
        $this->slugController = str_replace(" ", "", $this->slugController);

        return $this->slugController;
    }

    private function slugMetodo($slugMetodo)
    {
        $this->slugMetodo = $this->slugController($slugMetodo);
        //Converter para minusculo a primeira letra
        $this->slugMetodo = lcfirst($this->slugMetodo);

        return $this->slugMetodo;
    }
}
