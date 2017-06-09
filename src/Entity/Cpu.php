<?php

namespace App\Entity;

class Cpu extends Resource
{
    public function toString()
    {
        return parent::toString().' MHz';
    }
}
