<?php

namespace App\Entity;

class Ram extends Resource
{
    public function toString()
    {
        return parent::toString().' GB';
    }
}
