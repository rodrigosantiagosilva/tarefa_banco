<?php
use App\Models\Tarefa;
use App\Models\SessaoUsuario;
use Slim\Views\PhpRenderer;


$app->get('/', function ($request, $response) {
    $renderer = new PhpRenderer(__DIR__ . '/../views/login/');
    return $renderer->render($response, 'login.php');
});

$app->get('/cadastrar', function ($request, $response) {
    $renderer = new PhpRenderer('/view/login');
    return $renderer->render($response, 'cadastrar.php');
});

$app->get('/home', function ($request, $response) use ($banco) {
    $sessao = SessaoUsuario::getInstancia();
    $renderer = new PhpRenderer(__DIR__ . '/../views');

    if(!$sessao->estaLogado()){
        header('location: /');
        die;
    }
    
    $tarefa = new Tarefa($banco->getConnection());

    $dadosUsuario = [
    'usuario' => $sessao->getUsuario(),
    'tarefas' => $tarefa-> getAllByUser($sessao->getIdUsuario()),
    ];

    


    return $renderer->render($response, 'tarefa/listar.php',$dadosUsuario);
});





$app->get('/logout', function ($request, $response) {
    $sessao = SessaoUsuario::getInstancia();
    $sessao->logout();
    header('location: /');
    die;
});