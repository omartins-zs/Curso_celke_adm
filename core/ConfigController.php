<?php

namespace Core;

/**
 * Description of ConfigController
 *
 * @author Gabriel Matheus
 */

class ConfigController extends Config
{
    /** @var string $url Recebe a URL do .htaccess */
    private string $url;
    /** @var array $urlConjunto Recebe a URL convertida para array */
    private array $urlConjunto;
    private string $urlController;
    private string $urlMetodo;
    private string $urlParametro;
    private string $slugController;
    private string $slugMetodo;
    private string $urlLimpa;
    private array $format;

    public function __construct()
    {
        $this->configAdm();
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
            $this->url = $this->limparUrl($this->url);
            $this->urlConjunto = explode("/", $this->url);
            if (isset($this->urlConjunto[0])) {
                $this->urlController = $this->slugController($this->urlConjunto[0]);
            } else {
                $this->urlController = $this->slugController(CONTROLLER);
            }

            if (isset($this->urlConjunto[1])) {
                $this->urlMetodo = $this->slugMetodo($this->urlConjunto[1]);
            } else {
                $this->urlController = $this->slugController(CONTROLLER);
                $this->urlMetodo = $this->slugMetodo(METODO);
            }

            if (isset($this->urlConjunto[2])) {
                $this->urlParametro = $this->urlConjunto[2];
            } else {
                $this->urlParametro = "";
            }
        } else {
            $this->urlController = $this->slugController(CONTROLLER);
            $this->urlMetodo = $this->slugMetodo(METODO);
            $this->urlParametro = "";
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

    private function limparUrl($url)
    {
        //Eliminar as tags
        $this->urlLimpa = strip_tags($url);
        //Eliminar espaços em branco
        $this->urlLimpa = trim($this->urlLimpa);
        //Eliminar a barra no final da URL
        $this->urlLimpa = rtrim($this->urlLimpa, "/");
        $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr--------------------------------';
        $this->urlLimpa = strtr(utf8_decode($this->urlLimpa), utf8_decode($this->format['a']), $this->format['b']);

        return $this->urlLimpa;
    }
    /**
     * @method carregar Instanciar a classe e o método responsável em validar e carregar as páginas
     */
    public function carregar()
    {
        $carregarPageAdm = new \Core\CarregarPageAdm();
        $carregarPageAdm->carregarPg($this->urlController, $this->urlMetodo, $this->urlParametro);
    }
}
