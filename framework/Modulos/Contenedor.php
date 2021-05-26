<?php
namespace AlbertoCore\Modulos;

use ReflectionClass;
use ReflectionMethod;
/**
 * Clase encargada de inyectar las dependencias que necesite cada clase
 */
class Contenedor{
    public static $interfaces = [];
    /**
     * Se encarga de montar las dependencias que pueda necesitar, si
     * esa dependencia utiliza otras dependencias,  llamará a buildParams, para que las construya usando recursividad
     *
     * @param string $classname Nombre de la clase a montar
     * @return mixed
     */
    public static function build(string $classname){
        if (isset(self::$interfaces[$classname])){
            $classname = self::$interfaces[$classname];
        }
        $rc = new ReflectionClass($classname);
        $constructor = $rc->getConstructor();

        $params_array = [];
        if ($constructor){
            $constructor_params = $constructor->getParameters();
            if (count($constructor_params)>=1){
                self::buildParams($constructor_params,$params_array);
            }
        }

        $object = $rc->newInstanceArgs($params_array);
        return $object;
    }
    /**
     * Se encarga de montar las posibles dependencias que tengan nuestras dependencias
     * @param array $params Parametros del constructor
     * @param array $params_array Parametros ya construidos
     * @return void
     */
    public static function buildParams(array $params, array &$params_array){
        foreach ($params as $param) {
            $isClass = $param->getClass();
            if ($isClass){
                $params_array[] = self::build($isClass->name);
            }
        }
    }
}