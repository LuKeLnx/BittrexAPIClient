<?php

namespace ErikBooij\Bittrex\Model;

class Ticker
{
    /** @var float */
    private $ask = 0.0;

    /** @var float */
    private $bid = 0.0;

    /** @var float */
    private $last = 0.0;

    /**
     * @return float
     */
    public function getAsk() : float
    {
        return $this->ask;
    }

    /**
     * @param float $ask
     */
    public function setAsk(float $ask)
    {
        $this->ask = (float)$ask;
    }

    /**
     * @return float
     */
    public function getBid() : float
    {
        return $this->bid;
    }

    /**
     * @param float $bid
     */
    public function setBid(float $bid)
    {
        $this->bid = (float)$bid;
    }

    /**
     * @return float
     */
    public function getLast() : float
    {
        return $this->last;
    }

    /**
     * @param float $last
     */
    public function setLast(float $last)
    {
        $this->last = (float)$last;
    }
}
