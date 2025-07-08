<?php

use App\Models\SessaoUsuario;
use App\Models\Usuario;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Tarefa;

$app->get('/usuario/{id}/tarefas',
  function (Request $request, Response $response, array $args) use ($banco){
    $user_id =$args['id'];
    $tarefa = new Tarefa($banco->getConnection());
    $tarefas = $tarefa ->getAllByUser($user_id);
    $response->getBody()->write(json_encode($tarefas));
    return $response;
  });

  $app->post('/tarefa',
  function (Request $request, Response $response, array $args) use($banco){
$campos_obrigatorios = ['titulo',"descricao",'status',"user_id"];
    $body = $request->getParsedBody();
    try{
      $tarefa = new Tarefa($banco->getConnection());
      $tarefa->titulo = $body["titulo"] ?? '';
      $tarefa->descricao = $body["descricao"] ?? '';
      $tarefa->status = $body["status"] ?? false;
      $tarefa->user_id = $body["user_id"] ?? '';
      foreach($campos_obrigatorios as $campo){
        if(empty($tarefa->{$campo})){
          throw new \Exception("o campo {$campo} é obrigatório");
        };
      }
      $tarefa->create();
    }catch(\Exception $e){
      $response->getBody()->write(json_encode(['massage' => $e->getMessage() ]));
      return $response->withHeader('Content-Type','application/json') ->withStatus(400);
    }
    $response->getBody()->write(json_encode([
      'message' => 'Tarefa cadastrada com sucesso'
    ]));
    return $response->withHeader('Content-Type','application/json');
  });



$app->put('/tarefa/{id}',
  function (Request $request, Response $response, array $args) use($banco){
    $campos_obrigatorios = ['titulo',"descricao",'user_id',"status"];
    $body = json_decode($request->getBody()->getContents(), true);
    try{
      $tarefa = new Tarefa($banco->getConnection());
      $tarefa->id = $args["id"];
      $tarefa->titulo = $body["titulo"] ?? '';
      $tarefa->status = $body["status"] ?? false;
      // $tarefa->status = filter_var($body["status"], FILTER_VALIDATE_BOOLEAN) ?? false;
      $tarefa->user_id = $body["user_id"] ?? 0;
      $tarefa->descricao = $body["descricao"] ?? '';
      foreach($campos_obrigatorios as $campo){
        if(empty($tarefa->{$campo})&& $campo !== 'status'){
          throw new \Exception("o campo {$campo} é obrigatório");
        };
      }
      $tarefa->update();
    }catch(\Exception $e){
      $response->getBody()->write(json_encode(['massage' => $e->getMessage() ]));
      return $response->withHeader('Content-Type','application/json') ->withStatus(400);
    }
    $response->getBody()->write(json_encode([
      'message' => 'Tarefa atualizada com sucesso'
    ]));
    return $response->withHeader('Content-Type','application/json');
  });



  $app->delete('/tarefa/{id}',
  function (Request $request, Response $response, array $args) use($banco){
    $id = $args['id'];
    $usuario = new Tarefa($banco->getConnection());
    $usuario ->delete($id);
    $response->getBody()->write(json_encode(['massage' =>'Tarefa deletada']));
    return $response -> withHeader('Content-Type','application/json');
  });




$app->get('/tarefa/{id}',
  function (Request $request, Response $response, array $args) use($banco){
    $id = $args['id'];
    $usuario = new Tarefa($banco->getConnection());
    $usuarios = $usuario ->getTarefasById($id);
    $response->getBody()->write(json_encode($usuarios));
    return $response -> withHeader('Content-Type','application/json');
  });

$app->get('/usuario/{id}',
  function (Request $request, Response $response, array $args) use($banco){
    $id = $args['id'];
    $usuario = new Usuario($banco->getConnection());
    $usuarios = $usuario ->getUsuarioById($id);
    $response->getBody()->write(json_encode($usuarios));
    return $response -> withHeader('Content-Type','application/json');
  });

$app->delete('/usuario/{id}',
  function (Request $request, Response $response, array $args) use($banco){
    $id = $args['id'];
    $usuario = new Usuario($banco->getConnection());
    $usuario ->delete($id);
    $response->getBody()->write(json_encode(['massage' =>'Usuário deletado']));
    return $response -> withHeader('Content-Type','application/json');
  });

$app->post('/usuario',
  function (Request $request, Response $response, array $args) use($banco){
    $campos_obrigatorios = ['nome',"login",'senha',"email"];
    $body = $request->getParsedBody();
    try{
      $usuario = new Usuario($banco->getConnection());
      $usuario->nome = $body["nome"] ?? '';
      $usuario->email = $body["email"] ?? '';
      $usuario->senha = $body["senha"] ?? '';
      $usuario->login = $body["login"] ?? '';
      $usuario->foto_path = $body["foto_path"] ?? '';
      foreach($campos_obrigatorios as $campo){
        if(empty($usuario->{$campo})){
          throw new \Exception("o campo {$campo} é obrigatório");
        };
      }
      $usuario->create();
    }catch(\Exception $e){
      $response->getBody()->write(json_encode(['massage' => $e->getMessage() ]));
      return $response->withHeader('Content-Type','application/json') ->withStatus(400);
    }
    $response->getBody()->write(json_encode([
      'message' => 'Usuario cadastrado com sucesso'
    ]));
    return $response->withHeader('Content-Type','application/json');
  });






$app->put('/usuario/{id}',
  function (Request $request, Response $response, array $args) use($banco){
    $campos_obrigatorios = ['nome',"login",'senha',"email"];
    $body = json_decode($request->getBody()->getContents(), true);
    try{
      $usuario = new Usuario($banco->getConnection());
      $usuario->id = $args["id"];
      $usuario->nome = $body["nome"] ?? '';
      $usuario->email = $body["email"] ?? '';
      $usuario->senha = $body["senha"] ?? '';
      $usuario->login = $body["login"] ?? '';
      $usuario->foto_path = $body["foto_path"] ?? '';
      foreach($campos_obrigatorios as $campo){
        if(empty($usuario->{$campo})){
          throw new \Exception("o campo {$campo} é obrigatório");
        };
      }
      $usuario->update();
    }catch(\Exception $e){
      $response->getBody()->write(json_encode(['massage' => $e->getMessage() ]));
      return $response->withHeader('Content-Type','application/json') ->withStatus(400);
    }
    $response->getBody()->write(json_encode([
      'message' => 'Usuario atualizado com sucesso'
    ]));
    return $response->withHeader('Content-Type','application/json');
  });


$app->post('/login',
  function (Request $request, Response $response, array $args) use($banco){
    $campos_obrigatorios = ['login',"senha"];
    $body = json_decode($request->getBody()->getContents(), true);
    try{
   

      foreach($campos_obrigatorios as $campo){
        if(!isset($body[$campo]) || empty($body[$campo])){
          throw new \Exception("login ou senha vazios");
        }
      }
        $usuario = new Usuario($banco->getConnection());
        $login = $usuario->fazerLogin($body['login'],$body['senha']);
        if(empty($login)){
         throw new \Exception("login ou senha inválidos");
      }
      $sessao = SessaoUsuario::getInstancia();
      $sessao-> login($login);
      $response->getBody()->write(json_encode([
        'massage' => 'login realizado',
        'status' => true
    ]));
    return $response->withHeader('Content-Type','application/json');
    }catch(\Exception $e){
      $response->getBody()->write(json_encode([
        'massage' => $e->getMessage(),
        'status' => false
    ]));
      return $response->withHeader('Content-Type','application/json') ->withStatus(400);
    }
  });