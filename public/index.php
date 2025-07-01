<?php
use Slim\Factory\AppFactory;
use Slim\Exception\HttpNotFoundException;
use App\Database\Mariadb;
require __DIR__ . '/../vendor/autoload.php'; // se der erro, use __DIR__ . '/vendor/autoload.php';
 

$app = AppFactory::create();
$banco = new Mariadb();

require_once(__DIR__ .'/../rotas/api.php');
require_once(__DIR__ .'/../rotas/web.php');
$app->run();