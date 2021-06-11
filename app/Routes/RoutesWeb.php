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

use App\Controllers\Productos\ProductoController;
use App\Controllers\Productos\VerProductoController;
use App\Controllers\SigninController;
use App\Controllers\SpaController;
// use App\Middleware\FormOnlyNumbersMiddleware;
use App\Middleware\HttpMethodMiddleware;

class RoutesWeb{
    /**
     *  Usando el método estático del Router define las posibles rutas que puede pedir un usuario
     * @return void
     */
    public static function defineRoutes(){
        // Router::get('/producto/:id',VerProductoController::class); 
        Router::group('/api',function () {
            Router::get('/productos',VerTodosProductosController::class); 
            Router::get('/productos/:id',VerProductoController::class); 
        },[]);
        Router::post('/signin','App\Controllers\SigninController@signin'); 
        Router::post('/login','App\Controllers\LoginController@login'); 

        Router::get('/*',SpaController::class); 
    }
}   
