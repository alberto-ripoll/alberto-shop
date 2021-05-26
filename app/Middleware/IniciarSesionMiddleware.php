<?php
namespace App\Middleware;
use AlbertoCore\Modulos\Request;
use AlbertoCore\Modulos\Middleware;
use AlbertoCore\Modulos\Session;
class IniciarSesionMiddleware{
    public function __construct(Session $sesion)
    {
        
    }

    public function process(Request $req,Middleware $middleware){
            return $middleware->next(); 
    }     
}