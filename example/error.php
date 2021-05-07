<?php

require __DIR__ . '/../vendor/autoload.php';

use Omnipay\Omnipay;

$gateway = Omnipay::create('PayPo');

$response = $gateway->completePurchase()->send();
if($response->isSuccessful())
{
    var_dump('OK');
} 
else {
    var_dump('ERR');
}