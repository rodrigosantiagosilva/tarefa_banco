<?php
use App\Models\Usuario;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Factory\AppFactory;
use App\Database\Mariadb;
use App\Models\Tarefa;
require __DIR__ . './vendor/autoload.php'; // se der erro, use __DIR__ . '/vendor/autoload.php';
 
 
$app = AppFactory::create();
$banco = new Mariadb();
require_once(__DIR__ .'./rotas/api.php');
require_once(__DIR__ .'./rotas/web.php');
$app->run();