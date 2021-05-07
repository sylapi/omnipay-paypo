<?php

namespace Omnipay\PayPo\Message;

use Omnipay\PayPo\Message\AbstractRequest;

class CompletePurchaseRequest extends AbstractRequest
{
    public function sendData($data)
    {
        return new CompletePurchaseResponse($this, []);
    }

    public function getData()
    {
        return [];
    }
}
