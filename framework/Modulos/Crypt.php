<?php
namespace AlbertoCore\Modulos;

use App\keys\Keys;
class Crypt{
    private $secret_key = 'alberto';
    private $secret_iv = 'fFn3VLsuiv';
    private $method = 'AES-256-CBC';
    private $keys;

    // public function __construct(Keys $keys)
    // {
    //     $this->keys = $keys;
    //     if ($this->keys->secretKey)
    //         $this->secret_key = $this->keys->secretKey;
        
    // }


    /* Función para obtener la Key cifrada con SHA-256. */
    public function getSecretKey()
    {
        // Comprobando que la miembro clave no este vacío.
        if ((isset($this->secret_key[0]))) {
            return hash('sha256', $this->secret_key);
        } else {
            throw new \Exception("Error Secret Key Empty", 1);
        }
    }

    /* Función para obtener el IV cifrado con SHA-256. */
    public function getSecretIv()
    {

        // Comprobando que la miembro iv no este vacío.
        if ((isset($this->secret_iv[0]))) {
            // El método de cifrado AES-256-CBC espera un IV de 16 bytes.
            return substr(hash('sha256', $this->secret_iv), 0, 16);
        } else {
            throw new \Exception("Error Secret IV Empty", 1);
        }
    }

    /* Función que cifra un mensaje utilizando AES-256-CBC. */
    public function crypt_msg($message=null)
    {
        if ($message) {
            $output = openssl_encrypt(
                $message, // Mensaje a Cifrar.
                $this->method, // Método de Cifrado.
                $this->getSecretKey(), // Clave con la que cifrar.
                0, // Opciones.
                $this->getSecretIv() // IV (vector de inicialización).
            );
            
            // Codificando en b64.
            return base64_encode($output);
        } else {
            return false;
        }
    }

    /*alias de la funcion para que sea mas amigable*/
    public function encode($message=null)
    {
        return $this->crypt_msg($message);
    }

    /* Función que descifra un mensaje cifrado mediante AES-256-CBC. */
    public function decrypt_msg($message=null)
    {
        if (isset($message[0])) {
            return openssl_decrypt(
                base64_decode($message), // Mensaje a descifrar.
                $this->method, // Método de Cifrado.
                $this->getSecretKey(), // Clave con la que cifrar.
                0, // Opciones.
                $this->getSecretIv() // IV (vector de inicialización).
            );
        } else {
            return false;
        }
    }

    /*alias de la funcion para que sea mas amigable*/
    public function decode($message=null)
    {
        return $this->decrypt_msg($message);
    }

    public function encrypt($str='', $method='md5')
    {
        if (is_callable($method, true)) {
            return call_user_func($method, $str);
        }
    }
}
?>