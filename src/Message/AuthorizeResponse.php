<?php

namespace Omnipay\PayPo\Message;


use Omnipay\Common\Message\AbstractResponse;

class AuthorizeResponse extends AbstractResponse
{
    public function isSuccessful(): bool
    {   
        return !isset($this->data['code']) && !empty($this->data) && !is_null($this->getAccessToken());
    }


    public function getAccessToken()
    {
        return $this->data['access_token'] ?? null;
    }
}
