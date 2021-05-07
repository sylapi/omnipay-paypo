<?php

namespace Omnipay\PayPo\Message;

use Omnipay\PayPo\Message\AbstractResponse;

class CompletePurchaseResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return (isset($_GET['status']) && $_GET['status'] === 'OK');
    }
}
