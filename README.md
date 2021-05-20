# Omnipay: PayPo

![PHPStan](https://img.shields.io/badge/PHPStan-level%205-brightgreen.svg?style=flat) [![Build](https://github.com/sylapi/omnipay-paypo/actions/workflows/build.yaml/badge.svg?event=push)](https://github.com/sylapi/omnipay-paypo/actions/workflows/build.yaml) [![codecov.io](https://codecov.io/github/sylapi/omnipay-paypo/coverage.svg)](https://codecov.io/github/sylapi/omnipay-paypo/)

## Basic purchase example

```php
$gateway = Omnipay::create('PayPo');
$gateway->setPosId('posId');
$gateway->setClientSecret('clientSecret');

$response = $gateway->purchase([
    'amount' => '249.00', // min. 10.00 - max. 1000.00
    'currency' => 'PLN',
    'description' => 'My Payment',
    'transactionReference' => 'order#654321',
    'email' => 'my@email.com',
    'phone' => '500600700',
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
    // Not used
    'items' => [
        [
            "name" => "Product name",
            "price" => "249.00",
            "quantity" => 1
        ]
    ],
    'shipment' => Omnipay\PayPo\Enums\ShipmentType::COURIER, // Default: 0 (COURIER)
    'returnUrl' => 'http://example.dev/omnipay-paypo/success.php',
    'cancelUrl' => 'http://example.dev/omnipay-paypo/error.php',
    'notifyUrl' => 'http://example.dev/omnipay-paypo/callback.php'

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
```

## Basic purchase success example

```php
$gateway = Omnipay::create('PayPo');

$response = $gateway->completePurchase()->send();
if($response->isSuccessful())
{
    var_dump('OK');
}
else {
    var_dump('ERR');
}
```

## Basic confirm example

```php
$gateway = Omnipay::create('PayPo');
$gateway->setPosId('posId');
$gateway->setClientSecret('clientSecret');

$response = $gateway->confirm([
    'transactionId' => 'transactionId',
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
```

## Basic refund example

```php
$gateway = Omnipay::create('PayPo');
$gateway->setPosId('posId');
$gateway->setClientSecret('clientSecret');

$response = $gateway->refund([
    'transactionId' => 'transactionId',
    'amount' => '0.01'
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
```

## Basic void example

```php
$gateway = Omnipay::create('PayPo');
$gateway->setPosId('posId');
$gateway->setClientSecret('clientSecret');

$response = $gateway->void([
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
```

## Basic fetch transaction example

```php
$gateway = Omnipay::create('PayPo');
$gateway->setPosId('posId');
$gateway->setClientSecret('clientSecret');

$response = $gateway->fetchTransaction([
    'transactionId' => 'transactionId',
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
```

## Commands

| COMMAND | DESCRIPTION |
| ------ | ------ |
| composer tests | Tests |
| composer phpstan |  PHPStan |