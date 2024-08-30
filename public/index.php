<?php
session_start();
ob_start();
define('ACCESS_ALLOWED', true);
require "../vendor/autoload.php";

use \App\common\Environment;

Environment::load(dirname(__DIR__));
$env = getenv();
define('ENV', getenv());

// global $db;
// try {
//     $db = new PDO("mysql:dbname=" . ENV['DB_NAME'] . ";host=" . ENV['DB_HOST'], ENV['DB_USER'], ENV['DB_PASS']);
//     // echo 'Conexão ao banco de dados efetuada com sucesso.';
// } catch (PDOException $e) {
//     echo "ERRO: " . $e->getMessage();
//     exit;
// }

$url = new \App\Core\Core();
$url->loadPage();
