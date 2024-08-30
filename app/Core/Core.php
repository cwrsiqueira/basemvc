<?php

namespace App\Core;

class Core extends Config
{
    private string $url, $urlController, $urlParameter, $urlSlugController, $classLoad;
    private array $urlArray, $format;

    public function __construct()
    {
        $this->config();
        $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT) ?? '';

        if (!empty($this->url)) {
            $this->clearUrl();
            $this->urlArray = explode("/", $this->url);

            if (isset($this->urlArray[2])) {
                $this->urlController = $this->slugController($this->urlArray[2]);
            } else {
                $this->urlController = $this->slugController(CONTROLLERERRO);
            }
        } else {
            $this->urlController = $this->slugController(CONTROLLER);
        }
    }

    private function clearUrl(): void
    {
        $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr-------------------------------------------------------------------------------------------------';

        $this->url = strtr(mb_convert_encoding(rtrim(trim(strip_tags($this->url)), "/"), 'ISO-8859-1', 'UTF-8'), mb_convert_encoding($this->format['a'], 'ISO-8859-1', 'UTF-8'), mb_convert_encoding($this->format['b'], 'ISO-8859-1', 'UTF-8'));
    }

    private function slugController($slugController): string
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', strtolower($slugController))));
    }

    private function slugMethod($slugMethod): string
    {
        // Converte "meu-metodo" em "meuMetodo"
        return lcfirst(str_replace(' ', '', ucwords(str_replace('-', ' ', strtolower($slugMethod)))));
    }

    public function loadPage(): void
    {
        $this->classLoad = "App\\controllers\\" . $this->urlController;

        if (class_exists($this->classLoad)) {
            $this->loadClass();
        } else {
            $this->urlController = $this->slugController(CONTROLLERERRO);
            $this->loadPage();
        }
    }

    private function loadClass(): void
    {
        $classPage = new $this->classLoad();

        // Verifica se há um método na URL (3ª parte da URL, depois do controlador)
        $method = isset($this->urlArray[3]) ? $this->slugMethod($this->urlArray[3]) : 'index';

        if (method_exists($classPage, $method)) {
            $classPage->$method(); // Chama o método dinamicamente
        } else {
            die("Erro: Método '{$method}' não encontrado em '{$this->urlController}'. Tente novamente ou contacte o suporte: " . EMAILSUPORTE);
        }
    }
}
