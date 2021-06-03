<?php
/** ******          DOCS              ******

 * defineRoutes()
 *      - Usando el método estático del Router (Léase "/framework/Modulos/Router.php" para explicación más detallada)
 *        define las posibles rutas que puede pedir un usuario
 * 
*/
namespace App\Routes;
use AlbertoCore\Modulos\Router;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\PayController;
use App\Controllers\Productos\VerTodosProductosController;

use App\Controllers\PrincipalController;
use App\Controllers\Productos\ProductoController;
use App\Controllers\Productos\VerProductoController;
use App\Controllers\SigninController;
// use App\Middleware\FormOnlyNumbersMiddleware;
use App\Middleware\HttpMethodMiddleware;

class RoutesWeb{
    /**
     *  Usando el método estático del Router define las posibles rutas que puede pedir un usuario
     * @return void
     */
    public static function defineRoutes(){
        Router::get('/',PrincipalController::class); 
        Router::get('/pay',PayController::class); 
        Router::get('/producto',ProductoController::class); 

        Router::get('/productos/:id',LoginController::class); 

        Router::get('/signin',SigninController::class); 
        Router::post('/signin','App\Controllers\SigninController@signin'); 

        Router::get('/login',LoginController::class); 
        Router::post('/login','App\Controllers\LoginController@login'); 
        Router::get('/logout',LogoutController::class); 

        Router::group('/api',function () {
            Router::get('/productos',VerTodosProductosController::class); 
            Router::get('/producto',VerProductoController::class); 

            Router::get('/test',PrincipalController::class); 
        },[]);

    }
}   
