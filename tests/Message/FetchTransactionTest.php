<?php

namespace Omnipay\PayPo\Message;

use Omnipay\Tests\TestCase;

class FetchTransactionTest extends TestCase
{
    public function setUp()
    {
        $this->request = new FetchTransactionRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('FetchTransactionSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('ord_5985', $response->getTransactionReference());
        $this->assertNull($response->getMessage());
    }

    public function testSendError()
    {
        $this->setMockHttpResponse('FetchTransactionFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Not Found', $response->getMessage());
    }
}