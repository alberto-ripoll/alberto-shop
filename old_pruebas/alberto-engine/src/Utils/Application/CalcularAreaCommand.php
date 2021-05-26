<?php
namespace Src\Utils\Application;
use Src\Utils\Infrastructure\TrianguloGeometria;

class CalcularAreaCommand{
    public $geometriaInterface;

    public function __construct(TrianguloGeometria $geometriaInterface){
        $this->geometriaInterface = $geometriaInterface;
    }
    public function __invoke($lados){
        return $this->geometriaInterface->calcularArea($lados);
    }

}