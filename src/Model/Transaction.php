<?php

namespace ErikBooij\Bittrex\Model;

/**
 * Class Transaction
 * @package ErikBooij\Bittrex\Model
 */
class Transaction
{
    /** @var string */
    const STATE_FILLED = 'FILL';

    /** @var string */
    const STATE_PARTIALLY_FILLED = 'PARTIAL_FILL';

    /** @var string */
    const TYPE_BUY = 'BUY';

    /** @var string */
    const TYPE_SELL = 'SELL';

    /** @var string */
    private $filltype = '';

    /** @var int */
    private $id = 0;

    /** @var string */
    private $ordertype = '';

    /** @var float */
    private $price = 0.0;

    /** @var float */
    private $quantity = 0.0;

    /** @var \DateTime */
    private $timestamp;

    /**
     * @var float
     */
    private $total = 0.0;

    /**
     * @return string
     */
    public function getFilltype() : string
    {
        return $this->filltype;
    }

    /**
     * @param string $filltype
     */
    public function setFilltype(string $filltype)
    {
        $this->filltype = $filltype;
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getOrdertype() : string
    {
        return $this->ordertype;
    }

    /**
     * @param string $ordertype
     */
    public function setOrdertype(string $ordertype)
    {
        $this->ordertype = $ordertype;
    }

    /**
     * @return float
     */
    public function getPrice() : float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    /**
     * @return \DateTime
     */
    public function getProcessedTime() : \DateTime
    {
        return $this->timestamp;
    }

    /**
     * @param \DateTime $timestamp
     */
    public function setProcessedTime(\DateTime $timestamp)
    {
        $this->timestamp = $timestamp;
    }

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
