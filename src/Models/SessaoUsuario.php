<?php

namespace App\Models;

class SessaoUsuario{
    private static $instancia = null;
    private $usuarioLogado;

    private function __construct()
    {
        session_start();

    }

    public static function getInstancia(){
        if(self::$instancia === null){
            self::$instancia = new SessaoUsuario();
        }
        return self::$instancia;
    }

    public function login($dadosUsuario){
        $_SESSION['usuario'] = $dadosUsuario;
        $this->usuarioLogado = $dadosUsuario;
    }
    public function estaLogado(){
        return isset($_SESSION['usuario']);
    }
    public function getUsuario(){
        return $_SESSION['usuario'] ?? null;
    }
    public function getIdUsuario(){
        return $_SESSION['usuario']['id'] ?? null;
    }

    public function logout(){
        unset($_SESSION['usuario']);
        session_destroy();
        $this->usuarioLogado = null;
    }
    
}