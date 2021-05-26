<?php
namespace App\Models;


class ZapatoModel
{
    public static $talla;
    public static $color;

    function __construct(){
    }

    public static function showInfo(){
        echo "Este zapato es de color: ".self::getColor()." y es de la talla: ".self::getTalla()."\n";
    }

    public  function info(){
        echo "Este zapato es de color: ".self::getColor()." y es de la talla: ".self::getTalla()."\n";
    }
    /**
     * Get the value of talla
     */ 
    public static function getTalla()
    {
        return self::$talla;
    }

    /**
     * Set the value of talla
     *
     * @return  self
     */ 
    public static function setTalla($talla)
    {
        self::$talla = $talla;

    }

    /**
     * Get the value of color
     */ 
    public static function getColor()
    {
        return self::$color;
    }

    /**
     * Set the value of color
     *
     * @return  self
     */ 
    public static function setColor($color)
    {
        self::$color = $color;
    }
}
