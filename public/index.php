<?php
/** ******          DOCS              ******
 * LINEAS (20,21)
 *      Carga del Autoloader que cargará por defecto cualquier clase de cualquier archivo de
 *      nuestro framework                       (Léase "/framework/Autoloader.php" para explicación más detallada)
 * 
 * LINEAS (23,24,25)
 *      Definición de los use que necesitemos para ejecutar el framework. De momento necesitamos:
 *          - Contenedor de Dependencias        (Léase "/framework/Modulos/Contenedor.php" para explicación más detallada)
 *          - Core de nuestro framework         (Léase "/framework/Core.php" para explicación más detallada)
 *          - Archivo de definición de rutas    (Léase "/app/RoutesWeb.php" para explicación más detallada)
 * 
 * LINEAS (27,28,29)
 *      Se carga el contenedor de dependencias que cargará todas las dependencias de nuestro archivo Core
 *      Se definen las rutas necesarias para el funcionamiento de la aplicación
 *      Se llama al método invoke para guardar las rutas y enrutar si es necesario
 */

define('alRUTA', '../');
require_once "../framework/Autoloader.php";

use AlbertoCore\Modulos\Contenedor;
use AlbertoCore\Core;
use App\Routes\RoutesWeb;
use App\Middleware\IniciarSesionMiddleware;
use App\Provider\AppInterfaces;

$core = Contenedor::build(Core::class);
$core->defineRouterPackage(RoutesWeb::class);
$core->defineInterfaces(AppInterfaces::class);
$core->defineMiddlewarePackage([IniciarSesionMiddleware::class]);

$res = $core->next();   //Inicia el proceso de pasar por todos los middleware
$res->send();           //Devuelve la respuesta obtenida     e
