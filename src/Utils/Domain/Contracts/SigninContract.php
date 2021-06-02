<?php
namespace Src\Utils\Domain\Contracts;

class SigninContract{
    //;
    public static $rules = [
        "nombre"=>['isRequired','isAlphaNumeric'],
        "email"=>['isRequired','isEmail'],
        "ciudad"=>['onlyLetters'],
        "resultado"=>['isRequired','isNumeric'],
        "username"=>['isRequired','isAlphaNumeric'],
        "password"=>['isRequired']
    ];
}