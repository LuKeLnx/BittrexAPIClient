<?php

namespace ErikBooij\Bittrex\Model;

class OpenOrder
{
    /** @var bool */
    private $cancelInitiated = false;

    /** @var float */
    private $commissionPaid = 0.0;

    /** @var string */
    private $condition = '';

    /** @var float */
    private $conditionTarget = 0.0;

    /** @var bool */
    private $immediateOrCancel = false;

    /** @var bool */
    private $isConditional = false;

    /** @var float */
    private $limit = 0.0;

    /** @var string */
    private $market = '';

    /** @var \DateTime */
    private $opened;

    /** @var string */
    private $orderType = '';

    /** @var string */
    private $orderUuid = '';

    /** @var float */
    private $price = 0.0;

    /** @var float */
    private $pricePerUnit = 0.0;

    /** @var float */
    private $quantity = 0.0;

    /** @var float */
    private $quantityRemaining = 0.0;

    /** @var string */
    private $uuid = '';

    /**
     * @return boolean
     */
    public function isCancelInitiated() : bool
    {
        return $this->cancelInitiated;
    }

    /**
     * @param boolean $cancelInitiated
     */
    public function setCancelInitiated(bool $cancelInitiated)
    {
        $this->cancelInitiated = $cancelInitiated;
    }

    /**
     * @return float
     */
    public function getCommissionPaid() : float
    {
        return $this->commissionPaid;
    }

    /**
     * @param float $commissionPaid
     */
    public function setCommissionPaid(float $commissionPaid)
    {
        $this->commissionPaid = $commissionPaid;
    }

    /**
     * @return string
     */
    public function getCondition() : string
    {
        return $this->condition;
    }

    /**
     * @param string $condition
     */
    public function setCondition(string $condition)
    {
        $this->condition = $condition;
    }

    /**
     * @return float
     */
    public function getConditionTarget() : float
    {
        return $this->conditionTarget;
    }

    /**
     * @param float $conditionTarget
     */
    public function setConditionTarget(float $conditionTarget)
    {
        $this->conditionTarget = $conditionTarget;
    }

    /**
     * @return boolean
     */
    public function isImmediateOrCancel() : bool
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
     * @return boolean
     */
    public function isConditional() : bool
    {
        return $this->isConditional;
    }

    /**
     * @param boolean $isConditional
     */
    public function setIsConditional(bool $isConditional)
    {
        $this->isConditional = $isConditional;
    }

    /**
     * @return float
     */
    public function getLimit() : float
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
    public function getMarket() : string
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
     * @return \DateTime
     */
    public function getOpened() : \DateTime
    {
        return $this->opened;
    }

    /**
     * @param \DateTime $opened
     */
    public function setOpened(\DateTime $opened)
    {
        $this->opened = $opened;
    }

    /**
     * @return string
     */
    public function getOrderType() : string
    {
        return $this->orderType;
    }

    /**
     * @param string $orderType
     */
    public function setOrderType(string $orderType)
    {
        $this->orderType = $orderType;
    }

    /**
     * @return string
     */
    public function getOrderUuid() : string
    {
        return $this->orderUuid;
    }

    /**
     * @param string $orderUuid
     */
    public function setOrderUuid(string $orderUuid)
    {
        $this->orderUuid = $orderUuid;
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
     * @return float
     */
    public function getPricePerUnit() : float
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
    public function getQuantityRemaining() : float
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
    public function getUuid() : string
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
