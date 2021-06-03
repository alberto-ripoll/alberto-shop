<?php
namespace App\Controllers\Productos;

use AlbertoCore\Modulos\Controller;
use AlbertoCore\Modulos\Response;
use AlbertoCore\Modulos\Session;
use AlbertoCore\Modulos\Request;

use Src\Utils\Application\VerProductoCommand;

class ProductoController extends Controller{
    public $verTodosProductosCommand;
    public function __construct(Session $session, Response $response, VerProductoCommand $verProductoCommand,Request $req){
        $this->session = $session;
        $this->response = $response;
        $this->verProductoCommand = $verProductoCommand;
        $this->req = $req;

    }
    public function __invoke(){
        $idProducto =  $this->req->id;
        $producto = ($this->verProductoCommand)($idProducto);
        $this->responde('Producto',[
            "producto" => $producto
        ]);
    }
}



?>