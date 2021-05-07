<?php

namespace Omnipay\PayPo\Message;

use Omnipay\PayPo\Message\AbstractResponse;
use Omnipay\Common\Exception\InvalidRequestException;

class FetchTransactionResponse extends AbstractResponse
{
    public function isSuccessful()
    {   
        return $this->isSuccessfulResponse();
    }

    public function getTransactionReference()
    {
        $data = $this->getData();
        if (isset($data['referenceId']) && !empty($data['referenceId'])) {
            return (string) $data['referenceId'];
        } else {
            throw new InvalidRequestException("PayPo data is missing");
        }
    }
}
