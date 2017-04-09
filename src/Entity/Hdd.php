<?php

namespace App\Entity;

class Hdd extends Resource
{
    public function toString()
    {
        return parent::toString() . ' GB';
    }
}
