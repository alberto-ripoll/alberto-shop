<?php
namespace Src\Utils\Infrastructure;

use Src\Utils\Infrastructure\GeometriaInterface;

class TrapecioGeometria implements GeometriaInterface {
    public function calcularArea($lados){
        return (( ($lados['base_mayor'] + $lados['base_menor']) * $lados['altura']) /2);
    }
}