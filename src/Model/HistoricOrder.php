<?php

namespace ErikBooij\Bittrex\Model;

class HistoricOrder
{
    /** @var \DateTime */
    private $closed;

    /** @var float */
    private $commission = 0.0;

    /** @var \DateTime */
    private $created;

    /** @var bool */
    private $immediateOrCancel = false;

    /** @var float */
    private $limit = 0.0;

    /** @var string */
    private $market = '';

    /** @var float */
    private $price = 0.0;

    /** @var float */
    private $pricePerUnit = 0.0;

    /** @var float */
    private $quantity = 0.0;

    /** @var float */
    private $quantityRemaining = 0.0;

    /** @var string */
    private $type = '';

    /** @var string */
    private $uuid = '';

    /**
     * @return \DateTime
     */
    public function getClosed(): \DateTime
    {
        return $this->closed;
    }

    /**
     * @param \DateTime $closed
     */
    public function setClosed(\DateTime $closed)
    {
        $this->closed = $closed;
    }

    /**
     * @return float
     */
    public function getCommission(): float
    {
        return $this->commission;
    }

    /**
     * @param float $commission
     */
    public function setCommission(float $commission)
    {
        $this->commission = $commission;
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
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
     * @return boolean
     */
    public function isImmediateOrCancel(): bool
    {
        return $this->immediateOrCancel;
    }

    /**
     * @param boolean $immediateOrCancel
     */
    public function setImmediateOrCancel(bool $immediateOrCancel)
    {
        $this->immediateOrCancel = $immediateOrCancel;
    }

    /**
     * @return float
     */
    public function getLimit(): float
    {
        return $this->limit;
    }

    /**
     * @param float $limit
     */
    public function setLimit(float $limit)
    {
        $this->limit = $limit;
    }

    /**
     * @return string
     */
    public function getMarket(): string
    {
        return $this->market;
    }

    /**
     * @param string $market
     */
    public function setMarket(string $market)
    {
        $this->market = $market;
    }

    /**
     * @return float
     */
    public function getPrice(): float
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
     * @return float
     */
    public function getPricePerUnit(): float
    {
        return $this->pricePerUnit;
    }

    /**
     * @param float $pricePerUnit
     */
    public function setPricePerUnit(float $pricePerUnit)
    {
        $this->pricePerUnit = $pricePerUnit;
    }

    /**
     * @return float
     */
    public function getQuantity(): float
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
    public function getQuantityRemaining(): float
    {
        return $this->quantityRemaining;
    }

    /**
     * @param float $quantityRemaining
     */
    public function setQuantityRemaining(float $quantityRemaining)
    {
        $this->quantityRemaining = $quantityRemaining;
    }

    /**
     * @return string
     */
    public function getType(): string
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

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid)
    {
        $this->uuid = $uuid;
    }


}
