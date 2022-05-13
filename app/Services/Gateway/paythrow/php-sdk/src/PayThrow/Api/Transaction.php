<?php namespace PayThrow\Api;

use PayThrow\Common\PayThrowModel;

/**
 * Class Transaction
 * @property \PayThrow\Api\Amount amount
 *
 */

class Transaction extends PayThrowModel
{

    /**
     * @param \PayThrow\Api\Amount $amount
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    public function getAmount()
    {
        return $this->amount;
    }
}