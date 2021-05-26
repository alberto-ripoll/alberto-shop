<?php
namespace App\Middleware;
use AlbertoCore\Modulos\Response;

use AlbertoCore\Modulos\Request;
use AlbertoCore\Modulos\Middleware;
use AlbertoCore\Modulos\Contenedor;
/**
 * Middleware que se encarga de comprobar que las peticiones 
 * sean con el método POST
 */
class HttpMethodMiddleware
{
    public function process(Request $req,Middleware $middleware){
        if ($req->getMethod()=="POST"){
            return $middleware->next();
        }   
        $response = Contenedor::build(Response::class);
        // return $response->res();
        return $response->res(
            ["status"=>403,
            "data"=>["HTTP METHOD NO TE DEJA PASAR"],
            "viewname"=>alRUTA.'app/Views/Error.php']
        );
    }
}
