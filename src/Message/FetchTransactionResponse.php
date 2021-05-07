<?php

namespace Omnipay\PayPo\Message;

use Omnipay\PayPo\Message\AbstractResponse;

class FetchTransactionResponse extends AbstractResponse
{
    public function isSuccessful()
    {   
        return $this->isSuccessfulResponse();
    }
}
