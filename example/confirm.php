<?php

require __DIR__ . '/../vendor/autoload.php';

use Omnipay\Omnipay;

$gateway = Omnipay::create('PayPo');
$gateway->setPosId('posId');
$gateway->setClientSecret('clientSecret');


$transactionId = 'c0286d15-5e12-43d0-93d9-93057ff4cf36';

$response = $gateway->confirm([
    'transactionId' => $transactionId,
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