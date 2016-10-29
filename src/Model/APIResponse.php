<?php

namespace ErikBooij\Bittrex\Model;

/**
 * Class APIResponse
 * @package ErikBooij\Bittrex\Model
 */
class APIResponse
{
    /** @var array */
    private $data = [];

    /** @var string */
    private $message = '';

    /** @var bool */
    private $successful = true;

    /**
     * @return array
     */
    public function getData() : array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getMessage() : string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    /**
     * @return boolean
     */
    public function isSuccessful() : bool
    {
        return $this->successful;
    }

    /**
     * @param boolean $successful
     */
    public function setSuccessful(bool $successful)
    {
        $this->successful = $successful;
    }
}
