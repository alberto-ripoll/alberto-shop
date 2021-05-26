<?php
namespace App\Middleware;
use AlbertoCore\Modulos\Response;

use AlbertoCore\Modulos\Request;
use AlbertoCore\Modulos\Middleware;
use AlbertoCore\Modulos\Contenedor;
/**
 * Comprueba que en en los headers de la petición haya un requestId
 */
class AuthMiddleware
{
    public function process(Request $req,Middleware $middleware){
        if($req->__get("requestId")){
            return $middleware->next(); 
        }
        $response = Contenedor::build(Response::class);
        return $response->res(
            ["status"=>403,
            "data"=>["Auth NO TE DEJA PASAR"],
            "viewname"=>alRUTA.'app/Views/Error.php']
        );    }
}
