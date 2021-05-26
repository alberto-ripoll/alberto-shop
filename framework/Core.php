<?php
/** ******          DOCS              ******
 *  Constructor
 *      - Asigna las dependencias que necesita el core para funcionar
 * 
 * defineRouterPackage()
 *      - Añade el nombre de un paquete de rutas 
 * 
 *  Invoke
 *      - Último metodo que se ejecutará en el index, se encarga de cargar nuestras rutas (Léase "/app/RoutesWeb.php" para explicación más detallada)
 *        y de ejecutar los métodos que reciba del Router (Léase "/framework/Modulos/Router.php"), si es que se ha recibido una Request 
 * 
 * 
*/ 
namespace AlbertoCore;
use AlbertoCore\Modulos\Response;
use AlbertoCore\Modulos\Request;
use AlbertoCore\Modulos\Router;
use AlbertoCore\Modulos\Middleware;
use AlbertoCore\Modulos\Contenedor;
use AlbertoCore\Modulos\RouterHandler;

class Core extends Middleware{
    public $routerPackage;
    public $req;
    public $routerHandler;
    public $interfaces;
    public function __construct(Request $req, RouterHandler $routerHandler)
    {
        $this->req = $req;
        $this->routerHandler = $routerHandler;
    }
    public function defineInterfaces(string $interfazProvider){
        Contenedor::$interfaces = array_merge(Contenedor::$interfaces, $interfazProvider::$interfaces);
    }
    public function defineRouterPackage(string $name){
        $this->routerPackage[] = $name;
    }
    public function defineMiddlewarePackage(array $new_middlewares){
        $this->middlewares = array_merge($this->middlewares, $new_middlewares);
    }
    public function process(Request $req,Middleware $middleware){
        foreach ($this->routerPackage as $ruta) {
            $ruta::defineRoutes();
        }
        $response = $this->routerHandler->route();
        return $response;
    }
}