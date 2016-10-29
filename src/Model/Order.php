<?php

namespace ErikBooij\Bittrex\Model;

class Order
{
    /** @var string */
    const BUY = 'buy';

    /** @var string */
    const SELL = 'sell';

    /** @var float */
    private $quantity = 0.0;

    /** @var float */
    private $rate = 0.0;

    /** @var string */
    private $type = '';

    /**
     * @return float
     */
    public function getQuantity() : float
    {
        return $this->quantity;
    }

    /**
     * @param float $quantity
     */
    public function setQuantity(float $quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return float
     */
    public function getRate() : float
    {
        return $this->rate;
    }

    /**
     * @param float $rate
     */
    public function setRate(float $rate)
    {
        $this->rate = $rate;
    }

    /**
     * @return string
     */
    public function getType() : string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }
}
