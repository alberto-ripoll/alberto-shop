<?php
namespace App\Controllers;

use AlbertoCore\Modulos\Controller;
use AlbertoCore\Modulos\Response;
use AlbertoCore\Modulos\Request;
use Src\Utils\Application\ComprobarUsuarioExisteCommand;
use Src\Utils\Application\ComprobarPasswordCorrectaCommand;

class LoginController extends Controller{
    public $comprobarUsuarioExisteCommand;
    public $comprobarPasswordCorrectaCommand;
    public function __construct(Request $request, Response $response, ComprobarUsuarioExisteCommand $comprobarUsuarioExisteCommand, ComprobarPasswordCorrectaCommand $comprobarPasswordCorrectaCommand){
        $this->response = $response;
        $this->request = $request;
        $this->comprobarUsuarioExisteCommand = $comprobarUsuarioExisteCommand;
        $this->comprobarPasswordCorrectaCommand = $comprobarPasswordCorrectaCommand;
    }

        
    public function __invoke(){
        $this->responde('login',[
            ]);
    }
    public function login(){
        $username = $this->request->username;
        $password = $this->request->password;
        if ($username =='' || $password == ''){
            $this->responde('login',[
                ]);
            return;
        }
        if (!($this->comprobarUsuarioExisteCommand)($username)){
            $msg_error = "No existe";
            $this->responde('login',[
                $msg_error
                ]);
                // return;
        }
        if (!($this->comprobarPasswordCorrectaCommand)($username,$password)){
            echo "CONTRASEÑA INCORRECTA";
            return;
        }
        echo 'todo okay';
        $this->responde('login',[
            ]);
    }
}



?>