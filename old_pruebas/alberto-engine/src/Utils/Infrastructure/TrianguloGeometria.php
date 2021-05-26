<?php
namespace Src\Utils\Infrastructure;

use Src\Utils\Infrastructure\GeometriaInterface;

class TrianguloGeometria implements GeometriaInterface {
    public function calcularArea($lados){
        return ( ($lados['base'] * $lados['altura']) /2);
    }
}