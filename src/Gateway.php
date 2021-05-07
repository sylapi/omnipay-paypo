<?php

namespace Omnipay\PayPo;

use BadMethodCallException;
use Omnipay\Common\AbstractGateway;
use Omnipay\PayPo\Message\VoidRequest;
use Omnipay\PayPo\Message\RefundRequest;
use Omnipay\PayPo\Message\ConfirmRequest;
use Omnipay\PayPo\Message\PurchaseRequest;
use Omnipay\PayPo\Message\AuthorizeRequest;
use Omnipay\PayPo\Message\ExtendedFieldsTrait;
use Omnipay\PayPo\Message\CompletePurchaseRequest;
use Omnipay\PayPo\Message\FetchTransactionRequest;
use Omnipay\PayPo\Message\Notification;

/**
 * Class Gateway.
 */
class Gateway extends AbstractGateway
{
    use ExtendedFieldsTrait;

    public function getName()
    {
        return 'PayPo';
    }

    public function getDefaultParameters()
    {
        return [
            'posId'        => '',
            'clientSecret' => '',
            'testMode'     => true
        ];
    }


    public function initialize(array $options = [])
    {
        parent::initialize($options);
        $this->setApiUrl($this->getApiUrl());
        return $this;
    }

    public function purchase(array $options = array())
    {
        $this->setToken($this->authorize($options)->send()->getAccessToken());
        return parent::createRequest(PurchaseRequest::class, $options);
    }

    public function completePurchase(array $options = array())
    {
        $this->setToken($this->authorize($options)->send()->getAccessToken());
        return parent::createRequest(CompletePurchaseRequest::class, $options);
    }

    public function authorize(array $options = array())
    {
        return $this->createRequest(AuthorizeRequest::class, $options);
    }

    public function completeAuthorize(array $options = array())
    {
        // TODO: Implement completeAuthorize() method.
        throw new BadMethodCallException('The gateway does not support this feature.');
    }

    public function createCard(array $options = array())
    {
        throw new BadMethodCallException('The gateway does not support this feature.');
    }

    public function updateCard(array $options = array())
    {
        throw new BadMethodCallException('The gateway does not support this feature.');
    }

    public function deleteCard(array $options = array())
    {
        throw new BadMethodCallException('The gateway does not support this feature.');
    }

    public function fetchTransaction(array $options = [])
    {
        $this->setToken($this->authorize($options)->send()->getAccessToken());
        return parent::createRequest(FetchTransactionRequest::class, $options);
    }

    public function refund(array $options = array())
    {
        $this->setToken($this->authorize($options)->send()->getAccessToken());
        return parent::createRequest(RefundRequest::class, $options);
    }

    public function confirm(array $options = array())
    {
        $this->setToken($this->authorize($options)->send()->getAccessToken());
        return parent::createRequest(ConfirmRequest::class, $options);
    }

    public function acceptNotification()
    {
        return new Notification($this->httpRequest, $this->httpClient, $this);
    }

    public function void(array $options = array())
    {
        $this->setToken($this->authorize($options)->send()->getAccessToken());
        return parent::createRequest(VoidRequest::class, $options);
    }

    public function capture(array $options = array())
    {
        // TODO: Implement capture() method.
        throw new BadMethodCallException('The gateway does not support this feature.');
    }

}
