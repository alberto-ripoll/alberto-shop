<?php
namespace App\Controllers\Productos;

use AlbertoCore\Modulos\Controller;
use AlbertoCore\Modulos\Response;
use AlbertoCore\Modulos\Session;

use Src\Utils\Application\VerTodosProductosCommand;

class VerTodosProductosController extends Controller{
    public $verTodosProductosCommand;
    public $req;

    public function __construct(Session $session, Response $response, VerTodosProductosCommand $verTodosProductosCommand){
        $this->session = $session;
        $this->response = $response;
        $this->verTodosProductosCommand = $verTodosProductosCommand;
    }
    public function __invoke(){
        $allProducts = ($this->verTodosProductosCommand)();
        // echo json_encode($allProducts);
        $this->responde('',[
            "productos" => $allProducts
        ]);
    }
}



?>