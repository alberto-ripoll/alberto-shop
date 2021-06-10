<?php
namespace AlbertoCore\Modulos;
use AlbertoCore\Modulos\Request;
use AlbertoCore\Modulos\Contenedor;
use AlbertoCore\Modulos\Middleware;
/**
 * Clase que actua como manejador de rutas
 */
class RouterHandler extends Middleware{
    public $req;
    public $res;
    public $middleware;
    public $controller;
    public function __construct(Request $req, Response $res){
        $this->req = $req;
        $this->res = $res;
    }

    /**
     * Comprueba si la ruta existe y tiene un controlador asignado, si no devuelve 404
     *
     * @return mixed
     */
    public function route(){
        if ($this->req->getUri()){
            $controller = Router::route($this->req);
            if ($controller){
                $this->controller = $controller;
                $this->middlewares = $this->controller[3];
                return $this->next();
            }
            if (!$controller){
                return $this->res->res(["status"=>404,"data"=>["Esta ruta no existe!"],"viewname"=>'index.html']);
            }
        }
    }
    /**
     * Se encarga de ejecutar la llamada al controlador necesario y devolver la respuesta
     * @param Request $req
     * @param [type] $next
     * @return mixed
     */
    public function process(Request $req, $next){
        $objController = $this->controller[0];
        $metodo = $this->controller[1];
        $parametros_metodo = $this->controller[2];
        if (!$metodo){
            $objController();
        }else{
            call_user_func_array([$objController,$metodo],[$parametros_metodo]);
        }
        $this->res->file = $objController->file;
        $this->res->redirect = $objController->redirect;
        return $this->res->res(["status"=>200,"data"=>$objController->data,"viewname"=>$objController->viewname]);
    }
}