<?php

namespace App\Core;

class Model extends Config
{
    protected $db;

    public function __construct()
    {
        global $db;
        $this->db = $db;
        $this->db = $this->conexao();
        echo '<pre>';
        var_dump($this->db);
        echo '</pre>';
        exit;
    }
}
