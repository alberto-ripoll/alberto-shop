<?php
/** ******          DOCS              ******
 *  ORDEN DE SUCESOS
 *      1 -> Se define alRUTA para poder acceder a los archivos de configuración
 *      2 -> Se ejecuta el constructor
 *          2.1 -> Registra este autoloader para que PHP lo utilice cuando no encuentre las clases
 *          2.2 -> Se añaden las rutas de configuración de las reglas de PSR4
 *          2.3 -> Se ejecuta el método estático addPSR4 que se encarga de añadir los namespaces de las carpetas(que están en minúscula) 
 *                  para que cumplan con las reglas del PSR4 (PascalCase)
 *          2.4 -> Se añade al final del array de búsquedas '\\' y al de reemplazar '/'
 * 
 *   CUANDO SE DISPARA EL AUTOLOAD PARA CARGAR UNA CLASE
 *      1 -> Se almacena en $className el nombre de la clase que se va a cargar, y si existe se carga
 */
if (!defined('alRUTA')){
    define('alRUTA','../');
}
class Autoloader{
    private static $search = [];
    private static $replace = [];

    public function __construct()
    {
        $this->register();

        if(file_exists( alRUTA  . 'config/psr-4.php'))
        require_once alRUTA  . 'config/psr-4.php';

        self::$search[] = '\\';
        self::$replace[] = '/';                
    }

    public function register(){
        spl_autoload_register([$this,'load']);
    }

    public static function addPSR4($nameSpace, $route){
        self::$search[] = $nameSpace;
        self::$replace[] = $route;
    }

    public function load($className){

        $className = str_replace(self::$search,self::$replace,$className);
        
        if (file_exists(alRUTA . $className. '.php')){
            require_once alRUTA . $className . '.php';
        }
    
    }
}
$loader = new Autoloader;
?>