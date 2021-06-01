<?php
namespace Src\Utils\Domain\Contracts;

class SigninContract{
    //;
    public static $rules = [
        "nombre"=>['isRequired','isString'],
        "email"=>['isEmail'],
        "ciudad"=>['onlyLetters'],
        "resultado"=>['isRequired','isNumeric'],
        "username"=>['isRequired','isAlphaNumeric'],
        "password"=>['isRequired','isAlphaNumeric']
    ];
}