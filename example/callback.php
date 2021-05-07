<?php

require __DIR__ . '/../vendor/autoload.php';

use Omnipay\Omnipay;

$gateway = Omnipay::create('PayPo');
$gateway->setPosId('posId');
$gateway->setClientSecret('clientSecret');

try{
    $response = $gateway->acceptNotification();

    var_dump($response->getData());
    var_dump($response->getTransactionReference());
    var_dump($response->getTransactionStatus());
    var_dump($response->getTransactionId());
    var_dump($response->getLastUpdate());
    var_dump($response->getAmount());

} catch (\Exception $e) {
    // var_dump($e->getMessage());
    http_response_code(400);
}