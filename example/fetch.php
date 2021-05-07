<?php

require __DIR__ . '/../vendor/autoload.php';

use Omnipay\Omnipay;

$gateway = Omnipay::create('PayPo');
$gateway->setPosId('posId');
$gateway->setClientSecret('clientSecret');

$response = $gateway->fetchTransaction([
    'transactionId' => 'transactionId'
])->send();
if($response->isSuccessful())
{
    var_dump($response->getData());
} 
else {
    $error = $response->getMessage();
    $code = $response->getCode();
 
    var_dump($error);
    var_dump($code);
}