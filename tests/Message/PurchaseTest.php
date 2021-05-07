<?php

namespace Omnipay\PayPo\Message;

use Omnipay\Tests\TestCase;

class PurchaseTest extends TestCase
{
    protected $request;
    
    public function setUp()
    {
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertSame('e41ac7cb-2fd2-459d-8a0d-a47e7e2e4374', $response->getTransactionId());
        $this->assertSame('https://process.sandbox.paypo.pl/e41ac7cb-2fd2-459d-8a0d-a47e7e2e4374', $response->getRedirectUrl());
        $this->assertNull($response->getMessage());
    }

    public function testSendError()
    {
        $this->setMockHttpResponse('PurchaseFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame(409, $response->getCode());
        $this->assertSame('ReferenceId already in use', $response->getMessage());
    }
}