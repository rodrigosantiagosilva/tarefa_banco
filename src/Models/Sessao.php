<?php

namespace App\Models;

class Sessao{
    private static $sessao = null;

    protected __construct($login){
        start_session();

        $_SESSION =[
            'logado' = $login;
        ]
    }
}








