<?php

namespace App\Middleware;

use AlbertoCore\Modulos\Response;
use AlbertoCore\Modulos\Request;
use AlbertoCore\Modulos\CustomExcepcion;
use Src\Utils\Exception\ExceptionModule;
use Src\Utils\Infrastructure\Exceptions\TestException;
/**
 * Middleware que lanza las excepciones que puedan
 * ocurrir al procesar la peticion
 */
class ExceptionMiddleware
{
    public $res;

    public function __construct(Response $res)
    {
        $this->response = $res;
        $this->setErrorHandler();
    }

    private function setErrorHandler()
    {
        set_error_handler([$this,'handleError']);
    }

    public function handleError($errno, $errstr, $errfile, $errline)
    {
        throw new CustomExcepcion($errno, $errstr, $errfile, $errline);
    }

    public function process(Request $request, $handler)
    {
        try {
            return $handler->next();
        }     
        catch(TestException $error){
            echo $error->getSourceMessage();
        }
        catch (\Exception $error) {
            echo "ERROR FINAL";
            return $this->response->res(
                ["status"=>403,
                "data"=>["EXCEPCION ERROR"],
                "viewname"=>alRUTA.'app/Views/Error.php']
            );
            // $response = new Response($request);
            // ($this->logErrorCommand)($error);
            // $response->status = 500;
            // return $response;
        }
    }
}
