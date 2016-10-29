<?php

namespace ErikBooij\Bittrex\Model;

/**
 * Class Currency
 * @package ErikBooij\Bittrex\Model
 */
class Currency
{
    /** @var bool */
    private $active = false;

    /** @var string */
    private $baseAddress = "";

    /** @var string */
    private $coinType = "";

    /** @var string */
    private $longName = '';

    /** @var int */
    private $minConfirmation = 1;

    /** @var string */
    private $shortName = '';

    /** @var float */
    private $txFee = 0.0;

    /**
     * @param string $shortName
     * @param string $longName
     */
    public function __construct($shortName = '', $longName = '')
    {
        $this->shortName = $shortName;
        $this->longName = $longName;
    }

    /**
     * @return boolean
     */
    public function isActive() : bool
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     */
    public function setActive(bool $active)
    {
        $this->active = $active;
    }

    /**
     * @return string
     */
    public function getBaseAddress() : string
    {
        return $this->baseAddress;
    }

    /**
     * @param string $baseAddress
     */
    public function setBaseAddress(string $baseAddress)
    {
        $this->baseAddress = $baseAddress;
    }

    /**
     * @return string
     */
    public function getCoinType() : string
    {
        return $this->coinType;
    }

    /**
     * @param string $coinType
     */
    public function setCoinType(string $coinType)
    {
        $this->coinType = $coinType;
    }

    /**
     * @return string
     */
    public function getLongName() : string
    {
        return $this->longName;
    }

    /**
     * @param string $longName
     */
    public function setLongName(string $longName)
    {
        $this->longName = (string)$longName;
    }

    /**
     * @return int
     */
    public function getMinConfirmation() : int
    {
        return $this->minConfirmation;
    }

    /**
     * @param int $minConfirmation
     */
    public function setMinConfirmation(int $minConfirmation)
    {
        $this->minConfirmation = $minConfirmation;
    }

    /**
     * @return string
     */
    public function getShortName() : string
    {
        return $this->shortName;
    }

    /**
     * @param string $shortName
     */
    public function setShortName(string $shortName)
    {
        $this->shortName = (string)$shortName;
    }

    /**
     * @return float
     */
    public function getTxFee() : float
    {
        return $this->txFee;
    }

    /**
     * @param float $txFee
     */
    public function setTxFee(float $txFee)
    {
        $this->txFee = $txFee;
    }
}
