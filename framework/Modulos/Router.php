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
        'DELETE'=>[]
    ];
    /**
     * Se encarga de añadir las rutas recibidas al array asociativo de rutas, con el formato correspondiente
     *
     * @param string $method Metodo HTTP
     * @param string $ruta URI a la que se quiere acceder
     * @param string $controller Controlador encargado de la ruta
     * @return void
     */
    public static function addRutas(string $method, string $ruta, string $controller,array $middlewares){
        self::$rutas[$method][] = ['RUTA'=>$ruta,'CONTROLLER'=>$controller,'MIDDLEWARES'=>$middlewares];
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

            if($rutasMetodoHTTP[$i]['RUTA'] === $path){         // Si existe la ruta...

                $rutaController = $rutasMetodoHTTP[$i]['CONTROLLER'];
                $partesRutaController = explode('@',$rutaController);
                $claseController = $partesRutaController[0];
                $metodoController = $partesRutaController[1] ?? null;

                if (isset($metodoController)){

                    if (isset($query)){                             // Ej: $query = 'prueba=2&usuario=german'

                        parse_str($query, $parametros);             // https://www.php.net/manual/es/function.parse-str.php

                        //Devuelvo el controlador, con el metodo a ejecutar y con parametros
                        return [Contenedor::build($claseController),$metodoController,$parametros,$rutasMetodoHTTP[$i]['MIDDLEWARES']];

                    }
                     //Devuelvo el controlador, con el metodo a ejecutar pero sin parametros
                    return [Contenedor::build($claseController),$metodoController,[],$rutasMetodoHTTP[$i]['MIDDLEWARES']];

                }
                //Devuelvo el controlador sin parametros ni metodo a ejecutar
                return [Contenedor::build($claseController),'',[],$rutasMetodoHTTP[$i]['MIDDLEWARES']];;
            };
        }

        return false;
    }

}