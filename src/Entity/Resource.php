<?php

namespace App\Entity;

class Resource
{
    /** @var int */
    private $amount = 0;

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * Resource constructor.
     *
     * @param int $amount
     */
    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    /**
     * Subtract resource amount.
     *
     * @param int $amount
     *
     * @return $this
     */
    public function subtract(int $amount)
    {
        $this->amount -= $amount;

        return $this;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return (string) $this->amount;
    }
}
