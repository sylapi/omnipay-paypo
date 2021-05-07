<?php

namespace Omnipay\PayPo\Message;

abstract class AbstractResponse extends \Omnipay\Common\Message\AbstractResponse
{

    private $message;
    private $code;

    const DEFAULT_MESSAGE = 'Something went wrong.';

    public function isSuccessfulResponse()
    {
        $success = !(isset($this->data['code']) && $this->data['code'] > 299); 

        if($success === false)
        {
            $this->setMessage($this->data['message'] ?? self::DEFAULT_MESSAGE);
            $this->setCode($this->data['code'] ?? null);
        }

        return $success;
    }
    
    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($value)
    {
        return $this->message = $value;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($value)
    {
        return $this->code = $value;
    }
}