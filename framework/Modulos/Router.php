<?php

namespace AlbertoCore\Modulos;
use AlbertoCore\Modulos\Request;
use AlbertoCore\Modulos\Contenedor;
/**
 * Clase Router encargada de almacenar las rutas de nuestra aplicación y resolverlas con 
 * su controlador asignado.
 */
class Router{
    /**
     * Array asociativo con el formato ['METODO_HTTP'=>['RUTA'=>'/URL_SOLICITADA','CONTROLLER'=>'CONTROLADOR_ENCARGADO'],
     * @var array
     */
    public static $rutas = [
        'GET'=>[],
        'POST'=>[],
        'PUT'=>[],
        'DELETE'=>[],
    ];
    public static $groups;
    public static $matchedGroup =false;
    /**
     * Se encarga de añadir las rutas recibidas al array asociativo de rutas, con el formato correspondiente
     *
     * @param string $method Metodo HTTP
     * @param string $ruta URI a la que se quiere acceder
     * @param string $controller Controlador encargado de la ruta
     * @return void
     */
    public static function addRutas(string $method, string $ruta, string $controller,array $middlewares){
        if (self::$matchedGroup){
            $group = self::$matchedGroup;
            $ruta = $group['route'].$ruta;
            $middleware = array_merge($group['middleware'],$middlewares);
        }
        self::$rutas[$method][] = ['RUTA'=>$ruta,'CONTROLLER'=>$controller,'MIDDLEWARES'=>$middlewares];
    }
    public static function getRouteParams($route){
        $params = [];
        $result = preg_match_all('/:([a-z]+)+/', $route , $params);
        if ($result){
            $params = $params[1];
            $fields = array_splice($params,0);
            $fileds = array_flip($fields);
            $fields = array_fill_keys($fields, '');
            return $fields;
        }
             
        
        return false;
    }
    public static function getRouteParamRule($route,$routeParams){
        if ($routeParams)
            $route = preg_replace('/:([a-z]+)/', '(?P<\1>[^/]+)', $route);
        $route = str_replace('/', '\/', $route);
        return $route;
    }
    public static function get(string $ruta, string $controller,array $middlewares=[]){
        self::addRutas('GET',$ruta,$controller,$middlewares);
    }
    public static function post(string $ruta, string $controller,array $middlewares=[]){
        self::addRutas('POST',$ruta,$controller,$middlewares);
    }
    public static function put(string $ruta, string $controller,array $middlewares=[]){
        self::addRutas('PUT',$ruta,$controller,$middlewares);
    }
    public static function delete(string $ruta, string $controller,array $middlewares=[]){
        self::addRutas('DELETE',$ruta,$controller,$middlewares);
    }
    public function group(string $route,callable $callback,array $middlewares=[]){
        self::$groups[] =[
            'route'=>$route,
            'callback'=>$callback,
            'middleware'=>$middlewares
        ];
    }

    public static function resetRoutes(){
        self::$rutas = [
            'GET'=>[],
            'POST'=>[],
            'PUT'=>[],
            'DELETE'=>[]
        ]; 
    }
     /**
     * Comprueba la existencia de la ruta del objeto Request recibido en el array asociativo de rutas que cargamos al inicio de la ejecución. En caso de
     * existir devuelve las acciones a realizar montando el controlador adecuado usando el Contenedor, si no devuelve false.
     *
     * @param Request $req
     * @return mixed        Se devuelve el controlador o false
     */
    public static function route(Request $req){

        // Suponiendo que la URL fuera: desarrollo2.zataca.com/test?prueba=2&usuario=german

        $uri = $req->getUri();                      // $uri = '/test?prueba=2&usuario=german'
        $urlComponents = parse_url($uri);           // Array asociativo con valores de los diferentes componentes de la URL
        $path =  $urlComponents['path'];            // $path = '/test'
        $query = $urlComponents['query'] ?? null;           // $query = 'prueba=2&usuario=german'

        $rutasMetodoHTTP = self::$rutas[$req->getMethod()];
        $cantRutas = count($rutasMetodoHTTP);

        // Para cada ruta que se disponga de un método HTTP en nuestros paquetes de rutas cargados
        for ($i=0; $i < $cantRutas; $i++) {
            //Si la ruta tiene parámetros
            $params = self::getRouteParams($rutasMetodoHTTP[$i]['RUTA'] );
            $ruta = self::getRouteParamRule($rutasMetodoHTTP[$i]['RUTA'],$params);
            if ( preg_match('/^' . $ruta .'$/', $path, $matches)){ // Si existe la ruta...
                if ($params)
                    $params = (array_intersect_key($matches,$params));

                $rutaController = $rutasMetodoHTTP[$i]['CONTROLLER'];
                $partesRutaController = explode('@',$rutaController);
                $claseController = $partesRutaController[0];
                $metodoController = $partesRutaController[1] ?? null;
                
                if (isset($metodoController)){

                    if (isset($params)){                             // Ej: $params = ':id=2'

                        //Devuelvo el controlador, con el metodo a ejecutar y con parametros
                        return [Contenedor::build($claseController),$metodoController,$params,$rutasMetodoHTTP[$i]['MIDDLEWARES']];

                    }
                     //Devuelvo el controlador, con el metodo a ejecutar pero sin parametros
                    return [Contenedor::build($claseController),$metodoController,[],$rutasMetodoHTTP[$i]['MIDDLEWARES']];

                }
                if (isset($params)){                             
                    //Devuelvo el controlador sin parametros ni metodo a ejecutar
                    return [Contenedor::build($claseController),'',$params,$rutasMetodoHTTP[$i]['MIDDLEWARES']];;
                }
                //Devuelvo el controlador sin parametros ni metodo a ejecutar
                return [Contenedor::build($claseController),'',[],$rutasMetodoHTTP[$i]['MIDDLEWARES']];;
            }
        }

        $groups = self::$groups;
        foreach ($groups as $group){
            $rule = $group['route']; 
            $rule = str_replace('/', '\/', $rule);
            if (preg_match('/'.$rule.'/', $path, $matches)){
                if (is_callable($group['callback'])){
                    //borro la conf actual de rutas
                    //pzra evitar el matcheo con rutas fuera del grupo
                    self::resetRoutes();  
                    self::$matchedGroup = $group;
                    $group['callback']();   
                    self::$groups = []; 
                    
                    $result = self::route($req);
                    if ($result) return  $result;   
            }
         }           
    }
        return false;
    }

}