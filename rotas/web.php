<?php
use Slim\Views\PhpRenderer;


$app->get('/', function ($request, $response) {
    $renderer = new PhpRenderer(__DIR__ . '/../views/login/');
    return $renderer->render($response, 'login.php');
});

$app->get('/cadastrar', function ($request, $response) {
    $renderer = new PhpRenderer('/view/login');
    return $renderer->render($response, 'cadastrar.php');
});

$app->get('/recuperar_senha', function ($request, $response) {
    $renderer = new PhpRenderer('/view/login');
    return $renderer->render($response, 'recuperar_senha.php');
});