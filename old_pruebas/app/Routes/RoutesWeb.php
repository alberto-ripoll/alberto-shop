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

use App\Controllers\TestController1;
use App\Controllers\GeometriaController;
use App\Controllers\ExceptionController;
use App\Controllers\NotificationController;

// use App\Middleware\FormOnlyNumbersMiddleware;
use App\Middleware\HttpMethodMiddleware;

class RoutesWeb{
    /**
     *  Usando el método estático del Router define las posibles rutas que puede pedir un usuario
     * @return void
     */
    public static function defineRoutes(){
        Router::get('/',LoginController::class); 
        Router::post('/login','App\Controllers\LoginController@login',[HttpMethodMiddleware::class]);                

        Router::get('/app/test','App\Controllers\TestController1@test',[HttpMethodMiddleware::class]);                
        Router::post('/app/calcular',GeometriaController::class,[HttpMethodMiddleware::class]);                
        Router::get('/app/geometria','App\Controllers\GeometriaController@init',[]);                
        Router::get('/app/excepcion',ExceptionController::class,[]);        
        Router::get('/app/telegram','App\Controllers\NotificationController@init'); 
        Router::post('/app/enviar',NotificationController::class); 

        Router::get('/test',TestController1::class);        //Especifica el método que quiero ejecutar(test en este caso)      
        Router::post('/metodo','App\Controllers\TestController1@metodo');   //Especifica el método que quiero ejecutar(metodo en este caso)  
        Router::delete('/test',TestController1::class);
        Router::put('/test',TestController1::class);
    }
}   
