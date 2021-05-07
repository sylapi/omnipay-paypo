<?php

namespace Omnipay\PayPo\Message;


use Omnipay\PayPo\Message\AbstractResponse;

class VoidResponse extends AbstractResponse
{   
    public function isSuccessful()
    {   
        return $this->isSuccessfulResponse();
    }
}
