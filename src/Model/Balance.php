<?php

namespace ErikBooij\Bittrex\Model;

/**
 * Class Balance
 * @package ErikBooij\Bittrex\Model
 */
class Balance
{
    /** @var string */
    private $address = '';

    /** @var float */
    private $available = 0.0;

    /** @var string */
    private $currency = '';

    /** @var float */
    private $pending = 0.0;

    /** @var float */
    private $total = 0.0;

    /**
     * @return string
     */
    public function getAddress() : string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    /**
     * @return float
     */
    public function getAvailable() : float
    {
        return $this->available;
    }

    /**
     * @param float $available
     */
    public function setAvailable(float $available)
    {
        $this->available = $available;
    }

    /**
     * @return string
     */
    public function getCurrency() : string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return float
     */
    public function getPending() : float
    {
        return $this->pending;
    }

    /**
     * @param float $pending
     */
    public function setPending(float $pending)
    {
        $this->pending = $pending;
    }

    /**
     * @return float
     */
    public function getTotal() : float
    {
        return $this->total;
    }

    /**
     * @param float $total
     */
    public function setTotal(float $total)
    {
        $this->total = $total;
    }
}
