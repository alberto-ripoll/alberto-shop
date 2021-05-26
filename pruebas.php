<?php

define('alRUTA', './');
require_once "./AlbertoEngine/Autoloader.php";
use App\Controllers\TestController1;
use AlbertoCore\Modulos\Contenedor;

$controller = Contenedor::build(TestController1::class);
$controller->prueba();
