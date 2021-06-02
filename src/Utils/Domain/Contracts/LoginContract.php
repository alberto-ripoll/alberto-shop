<?php
namespace Src\Utils\Domain\Contracts;

class LoginContract{
    public static $rules = [
        "username"=>['isRequired'],
        "password"=>['isRequired']
    ];
}