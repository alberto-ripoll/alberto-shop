<?php
namespace App\Models;

use App\Models\FiguraModel;
use App\Models\UserModel;

class ArmarioModel
{
    public $user;
    public $figura;

    function __construct(UserModel $user, FiguraModel $figura){
        $this->user = $user;
        $this->figura = $figura;

    }

    public function showInfo(){
        echo "Este armario es del usuario: ".$this->user->getNombre()." y tiene la figura: ".$this->figura->getNombre()."\n";
    }
    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of figuras
     */ 
    public function getFiguras()
    {
        return $this->figuras;
    }

    /**
     * Set the value of figuras
     *
     * @return  self
     */ 
    public function addFigura(FiguraModel $figura)
    {
        $this->figuras = $figura;

        return $this;
    }
}
