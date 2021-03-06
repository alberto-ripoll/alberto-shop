<?php
namespace App\Controllers;

use AlbertoCore\Modulos\Controller;
use AlbertoCore\Modulos\Response;
use AlbertoCore\Modulos\Request;
use AlbertoCore\Modulos\Session;

use Src\Utils\Application\ComprobarUsuarioExisteCommand;
use Src\Utils\Application\ComprobarPasswordCorrectaCommand;
use Src\Utils\Domain\Contracts\LoginContract;
use Src\Utils\Application\ValidarRequestCommand;

class LoginController extends Controller{
    public $comprobarUsuarioExisteCommand;
    public $comprobarPasswordCorrectaCommand;
    public $validarRequestCommand;
    public $session;

    public function __construct(Session $session, Request $request, Response $response, ValidarRequestCommand $validarRequestCommand, ComprobarUsuarioExisteCommand $comprobarUsuarioExisteCommand, ComprobarPasswordCorrectaCommand $comprobarPasswordCorrectaCommand){
        $this->session = $session;
        $this->response = $response;
        $this->request = $request;
        $this->comprobarUsuarioExisteCommand = $comprobarUsuarioExisteCommand;
        $this->comprobarPasswordCorrectaCommand = $comprobarPasswordCorrectaCommand;
        $this->validarRequestCommand = $validarRequestCommand;
    }

        
    public function __invoke(){
        $this->responde('Login',[
            "username"=>"",
            "message"=>""
            ]);
    }
    public function login(){
        $username = $this->request->username;
        $password = $this->request->password;
        $input=[
            'username'=>$username,
            'password'=>$password
        ];
        $validator = ($this->validarRequestCommand)($input, LoginContract::$rules);
        if (!$validator['valid']){
            return $this->responde('Login',[
                "username"=>$username,
                "message"=>"No puede ser vacio"
                ]);   
        }
        $existe = ($this->comprobarUsuarioExisteCommand)($username);
        if (!$existe){
            return $this->responde('Login',[
                "username"=>$username,
                "message"=>"Este usuario no existe"
                ]);
        }
        $contrase??aCorrecta = ($this->comprobarPasswordCorrectaCommand)($username,$password);
        if (!$contrase??aCorrecta){
            return $this->responde('Login',[
                "username"=>$username,
                "message"=>"Contrase??a incorrecta"
                ]);    
        ;
        }
        $this->redirect= '/';
        $this->session->logged = true;
        $this->session->usuario = $username;

    }
    
}



?>