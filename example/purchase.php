<?php

require __DIR__ . '/../vendor/autoload.php';


use Omnipay\Omnipay;
use Omnipay\PayPo\Enums\ShipmentType;

$gateway = Omnipay::create('PayPo');
$gateway->setPosId('posId');
$gateway->setClientSecret('clientSecret');
$gateway->setTestMode(true);

$response = $gateway->purchase([
    'amount' => '249.00', // 10.00 - 1000.00
    'currency' => 'PLN',
    'description' => 'My Payment',
    'transactionReference' => 'order#654321',
    'email' => 'd.serafinski@sylapi.com',
    'phone' => '504289693',
    'name' => 'Anna',
    'surname' => 'Nowak',
    'billingAddress' => [
        'street' => 'Kredytowa',
        'building' => '9a',
        'flat' => '3',
        'zip' => '00-950',
        'city' => 'Warszawa',
        'country' => 'PL', // Not require Default: PL
    ],
    'shippingAddress' => [
        'street' => 'Domaniewska',
        'building' => '37',
        'flat' => '',
        'zip' => '02-672',
        'city' => 'Warszawa',
        'country' => 'PL', // Not require Default: PL
    ],    
    'items' => [
        [
            "name" => "Product name",
            "price" => "10.00",
            "quantity" => 1
        ]
    ],
    'shipment' => ShipmentType::COURIER,
    'returnUrl' => 'http://localhost/omnipay-paypo/example/success.php',
    'cancelUrl' => 'http://localhost/omnipay-paypo/example/error.php',
    'notifyUrl' => 'http://localhost/omnipay-paypo/example/callback.php'

])->send();

if ($response->isSuccessful()) {

   if ($response->isRedirect()) {
        var_dump($response->getData());
        var_dump($response->getTransactionId());
        var_dump($response->getRedirectUrl());
    //    $response->redirect();
   }
   else {
       $data = $response->getData();
       var_dump($data);
   }
}
else {
   $error = $response->getMessage();
   $code = $response->getCode();
   var_dump($error);
   var_dump($code);
}
