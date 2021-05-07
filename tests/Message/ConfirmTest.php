<?php

namespace Omnipay\PayPo\Message;

use Omnipay\Tests\TestCase;

class ConfirmTest extends TestCase
{
    protected $request;

    public function setUp()
    {
        $this->request = new ConfirmRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('ConfirmSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getMessage());
    }

    public function testSendError()
    {
        $this->setMockHttpResponse('ConfirmFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Conflict', $response->getMessage());
    }
}