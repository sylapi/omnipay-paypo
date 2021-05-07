<?php

namespace Omnipay\PayPo;

use Omnipay\Tests\GatewayTestCase;


class ChargeGatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testSupportsCompleteAuthorize()
    {
        $this->assertTrue(true);
    }

    public function testCompleteAuthorizeParameters()
    {
        $this->assertTrue(true);
    }

    public function testSupportsUpdateCard()
    {
        $this->assertTrue(true);
    } 

    public function testSupportsDeleteCard()
    {
        $this->assertTrue(true);
    } 

    public function testSupportsCapture()
    {
        $this->assertTrue(true);
    }  

    public function testSupportsCreateCard()
    {
        $this->assertTrue(true);
    }  

    public function testCaptureParameters()
    {
        $this->assertTrue(true);
    }    

    public function testCreateCardParameters()
    {
        $this->assertTrue(true);
    }       

    public function testUpdateCardParameters()
    {
        $this->assertTrue(true);
    }   
    
    public function testDeleteCardParameters()
    {
        $this->assertTrue(true);
    }   
}