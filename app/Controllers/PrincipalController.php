<?php
namespace App\Controllers;

use AlbertoCore\Modulos\Controller;
use AlbertoCore\Modulos\Response;
use AlbertoCore\Modulos\Session;

use Src\Utils\Application\EstaLoggeadoCommand;
class PrincipalController extends Controller{
    public $estaLoggeadoCommand;
    public function __construct(Session $session, Response $response, EstaLoggeadoCommand $estaLoggeadoCommand ){
        $this->session = $session;
        $this->response = $response;
        $this->estaLoggeadoCommand = $estaLoggeadoCommand;
    }
    public function __invoke(){
        $isLogged = $this->session->logged;
        // $this->responde('Tienda',[
        //     "isLogged" => $isLogged  ,
        //     "message"=>'Bienvenido al init'
        // ]);
        $this->responde('Principal',[
            "isLogged" => $isLogged  ,
            "message"=>'Bienvenido al init'
        ]);
    }
}



?>