<?php


namespace Omnipay\PayPo\Message;

use Omnipay\PayPo\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{

    const DEFAULT_MESSAGE = 'Something went wrong.';

    private $message;
    private $code;
    
    public function isSuccessful()
    {   
        return $this->isSuccessfulResponse();
    }

    public function isRedirect()
    {
        return $this->isSuccessful();
    }

    public function getTransactionId()
    {
        return ($this->isSuccessful()) ? $this->data['transactionId'] : null;
    }

    public function getRedirectUrl()
    {
        return ($this->isRedirect()) ? $this->data['redirectUrl'] : null;
    }

    public function getRedirectData()
    {
        return $this->data;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getCode()
    {
        return $this->code;
    }
}
