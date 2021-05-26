<?php
namespace App\Controllers;

use Src\Utils\Infrastructure\Exceptions\TestException;

use AlbertoCore\Modulos\Controller;

class ExceptionController extends Controller{


    public function __invoke(){
        try {
            $num1=5;
            $num2=0;
            $total = $num1/$num2;
        } catch (\Exception $th) {
            if ($th->getMessage()=="Division by zeros")
            throw new TestException('Division entre 0');
            else throw new TestException('Ni puta idea');
        }
    }

}



?>