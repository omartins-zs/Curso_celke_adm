<?php

namespace Core;
/**
 * Description of ConfigController
 *
 * @author Gabriel Matheus
 */

class ConfigController extends Config
{

    private string $url;
    private array $urlConjunto;
    private string $urlController;
    private string $urlMetodo;
    private string $urlParamentro;
    private string $classe;

    public function __construct()
    {
        $this->configAdm();
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
            echo "Página que o usuário quer acessar: " . $this->url . "<br>";
            $this->urlConjunto = explode("/", $this->url);
            var_dump($this->urlConjunto);
            if (isset($this->urlConjunto[0])) {
                $this->urlController = $this->urlConjunto[0];
            } else {
                $this->urlController = CONTROLLER;
            }

            if (isset($this->urlConjunto[1])) {
                $this->urlMetodo = $this->urlConjunto[1];
            } else {
                $this->urlMetodo = METODO;
            }

            if (isset($this->urlConjunto[2])) {
                $this->urlParamentro = $this->urlConjunto[2];
            } else {
                $this->urlParamentro = "";
            }
        } else {
            echo "Criar a página default<br>";
            $this->urlController = CONTROLLER;
            $this->urlMetodo = METODO;
            $this->urlParamentro = "";
        }

        echo "Controller: {$this->urlController} <br>";
        echo "Método: {$this->urlMetodo} <br>";
        echo "Paramentro: {$this->urlParamentro} <br>";
    }

    public function carregar()
    {
        echo "Carregar as páginas<br>";
        $this->urlController = ucwords($this->urlController);
        echo "Controller corrigida: {$this->urlController}<br>";
        $this->classe = "\\App\\adms\\Controllers\\" . $this->urlController;
        $classCarregar = new $this->classe();
        $classCarregar->{$this->urlMetodo}();
    }
}
