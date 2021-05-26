<?php


/**
 * Plantilla que deben seguir todas las excepciones
 */
interface IException
{
    /* Protected methods inherited from Exception class */
    public function getMessage();                 // Mensaje de la excepcion
    public function getCode();                    // Codigo propio de la excepcion
    public function getFile();                    // Nombre del archivo que da error
    public function getLine();                    // Linea que da error
    public function getTrace();                   // Array de backtrace()
    public function getTraceAsString();           // Cadena formateada de la atrama
   
    /* Metodos sobreescribibles que se heredan de la clase de PHP Exception */
    public function __toString();                 // Cadena formateada a mostrar
    public function __construct($message = null, $code = 0);
}
/**
 * Excepcion base
 */
abstract class CustomException extends Exception implements IException
{
    protected $message = 'Unknown exception';     // Exception message
    private   $string;                            // Unknown
    protected $code    = 0;                       // User-defined exception code
    protected $file;                              // Source filename of exception
    protected $line;                              // Source line of exception
    private   $trace;                             // Unknown

    public function __construct($message = null, $code = 0)
    {
        if (!$message) {
            throw new $this('Unknown '. get_class($this));
        }
        parent::__construct($message, $code);
    }
   
    public function __toString()
    {
        return get_class($this) . " '{$this->message}' in {$this->file}({$this->line})\n"
                                . "{$this->getTraceAsString()}";
    }
}
?>


<?php
// Ahora se pueden crear Excepciones partiendo de la base: -->
class TestException extends CustomException {}
?>


<?php
//Prueba que muestra que toda la información se mantiene a través del backtrace. -->

function exceptionTest()
{
    try {
        throw new TestException();
    }
    catch (TestException $e) {
        echo "Caught TestException ('{$e->getMessage()}')\n{$e}\n";
    }
    catch (Exception $e) {
        echo "Caught Exception ('{$e->getMessage()}')\n{$e}\n";
    }
}

echo exceptionTest();
/*
Salida:

Caught TestException ('Unknown TestException')
TestException 'Unknown TestException' in C:\xampp\htdocs\CustomException\CustomException.php(31)
#0 C:\xampp\htdocs\CustomException\ExceptionTest.php(19): CustomException->__construct()
#1 C:\xampp\htdocs\CustomException\ExceptionTest.php(43): exceptionTest()
#2 {main}
*/
?>
