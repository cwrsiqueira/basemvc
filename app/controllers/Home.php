<?php

namespace App\Controllers;

if (!defined('ACCESS_ALLOWED')) {
    die('Acesso direto não permitido');
}

use App\Core\Controller;

class Home extends Controller
{
    private ?array $data = ['pagina' => 'Home'];

    public function termosDeUsoEPoliticasDePrivacidade()
    {
        $this->data['contato'] = ENV['EMAIL_SUPORTE'];
        $this->loadTemplate('termos-de-uso-e-politica-de-privacidade', $this->data);
    }

    public function index(): void
    {
        $this->loadTemplate('home', $this->data);
    }
}
