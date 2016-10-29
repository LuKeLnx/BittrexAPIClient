<?php

namespace ErikBooij\Bittrex\Model;

class MarketSummary
{
    /** @var float */
    private $ask = 0.0;

    /** @var float */
    private $baseVolume = 0.0;

    /** @var float */
    private $bid = 0.0;

    /** @var \DateTime */
    private $created;

    /** @var float */
    private $high = 0.0;

    /** @var float */
    private $last = 0.0;

    /** @var float */
    private $low = 0.0;

    /** @var string */
    private $marketName = '';

    /** @var int */
    private $openBuyOrders = 0;

    /** @var int */
    private $openSellOrders = 0;

    /** @var float */
    private $prevDay = 0.0;

    /** @var \DateTime */
    private $timeStamp;

    /** @var float */
    private $volume = 0.0;

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
        $this->ask = $ask;
    }

    /**
     * @return float
     */
    public function getBaseVolume() : float
    {
        return $this->baseVolume;
    }

    /**
     * @param float $baseVolume
     */
    public function setBaseVolume(float $baseVolume)
    {
        $this->baseVolume = $baseVolume;
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
        $this->bid = $bid;
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

    /**
     * @return float
     */
    public function getHigh() : float
    {
        return $this->high;
    }

    /**
     * @param float $high
     */
    public function setHigh(float $high)
    {
        $this->high = $high;
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
        $this->last = $last;
    }

    /**
     * @return float
     */
    public function getLow() : float
    {
        return $this->low;
    }

    /**
     * @param float $low
     */
    public function setLow(float $low)
    {
        $this->low = $low;
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
        $this->marketName = $marketName;
    }

    /**
     * @return int
     */
    public function getOpenBuyOrders() : int
    {
        return $this->openBuyOrders;
    }

    /**
     * @param int $openBuyOrders
     */
    public function setOpenBuyOrders(int $openBuyOrders)
    {
        $this->openBuyOrders = $openBuyOrders;
    }

    /**
     * @return int
     */
    public function getOpenSellOrders() : int
    {
        return $this->openSellOrders;
    }

    /**
     * @param int $openSellOrders
     */
    public function setOpenSellOrders(int $openSellOrders)
    {
        $this->openSellOrders = $openSellOrders;
    }

    /**
     * @return float
     */
    public function getPrevDay() : float
    {
        return $this->prevDay;
    }

    /**
     * @param float $prevDay
     */
    public function setPrevDay(float $prevDay)
    {
        $this->prevDay = $prevDay;
    }

    /**
     * @return \DateTime
     */
    public function getTimeStamp() : \DateTime
    {
        return $this->timeStamp;
    }

    /**
     * @param \DateTime $timeStamp
     */
    public function setTimeStamp(\DateTime $timeStamp)
    {
        $this->timeStamp = $timeStamp;
    }

    /**
     * @return float
     */
    public function getVolume() : float
    {
        return $this->volume;
    }

    /**
     * @param float $volume
     */
    public function setVolume(float $volume)
    {
        $this->volume = $volume;
    }


}
