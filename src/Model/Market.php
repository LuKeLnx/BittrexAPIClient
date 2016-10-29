<?php

namespace ErikBooij\Bittrex\Model;

/**
 * Class Market
 * @package ErikBooij\Bittrex\Model
 */
class Market
{
    /** @var Currency */
    private $marketCurrency;

    /** @var Currency */
    private $baseCurrency;

    /** @var float */
    private $minTradeSize = 0.0;

    /** @var string */
    private $marketName = '';

    /** @var bool */
    private $isActive = false;

    /** @var \DateTime */
    private $created;

    /**
     * @return Currency
     */
    public function getMarketCurrency() : Currency
    {
        return $this->marketCurrency;
    }

    /**
     * @param Currency $marketCurrency
     */
    public function setMarketCurrency(Currency $marketCurrency)
    {
        $this->marketCurrency = $marketCurrency;
    }

    /**
     * @return Currency
     */
    public function getBaseCurrency() : Currency
    {
        return $this->baseCurrency;
    }

    /**
     * @param Currency $baseCurrency
     */
    public function setBaseCurrency(Currency $baseCurrency)
    {
        $this->baseCurrency = $baseCurrency;
    }

    /**
     * @return float
     */
    public function getMinTradeSize() : float
    {
        return $this->minTradeSize;
    }

    /**
     * @param float $minTradeSize
     */
    public function setMinTradeSize(float $minTradeSize)
    {
        $this->minTradeSize = (float)$minTradeSize;
    }

    /**
     * @return string
     */
    public function getMarketName() : string
    {
        return $this->marketName;
    }

    /**
     * @param string $marketName
     */
    public function setMarketName(string $marketName)
    {
        $this->marketName = (string)$marketName;
    }

    /**
     * @return boolean
     */
    public function isIsActive() : bool
    {
        return $this->isActive;
    }

    /**
     * @param boolean $isActive
     */
    public function setIsActive(bool $isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return \DateTime
     */
    public function getCreated() : \DateTime
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;
    }
}
