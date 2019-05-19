<?php

namespace App\DTO;

abstract class BaseDTO
{

    public function toArray(){
        return (array) $this;
    }
}