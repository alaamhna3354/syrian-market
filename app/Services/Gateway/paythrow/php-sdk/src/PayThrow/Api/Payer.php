<?php
namespace PayThrow\Api;

use PayThrow\Common\PayThrowModel;

/**
 * Class Payer
 * @property string paymentMethod
 *
 */
class Payer extends PayThrowModel
{

    /**
     * Valid Values: ["paythrow"]
     * method will be like paythrow, paypal, stripe etc
     * @param  string  $method
     * @return $this
     */
    public function setPaymentMethod($method)
    {
        $this->paymentMethod = $method;
        return $this;
    }

    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

}
