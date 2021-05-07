<?php

namespace Omnipay\PayPo\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\NotificationInterface;
use Symfony\Component\HttpFoundation\Request;

class Notification implements NotificationInterface
{

    const X_PAYPO_SIGNATURE = 'X-PayPo-Signature';
    const REQUST_METHOD = 'POST';

    private $cachedData = null;

    private $httpRequest;

    private $httpClient;

    private $data;
    
    public function __construct(Request $httpRequest, $httpClient, $data)
    {
        $this->httpRequest = $httpRequest;
        $this->httpClient = $httpClient;
        $this->data = $data;
    }
    
    public function getData()
    {
        if (!$this->cachedData) {
            $content = trim($this->httpRequest->getContent());
            $incomingSignature = $this->getSignature($this->httpRequest);

            if(!$this->verifySignature($incomingSignature, $this->httpRequest)) {
                throw new InvalidRequestException('Invalid signature');
            }

            $this->cachedData = json_decode($content);
        }
        return $this->cachedData;
    }

    private function getSignature(Request $request)
    {

        if ($request->headers->has(self::X_PAYPO_SIGNATURE)) {
            return $request->headers->get(self::X_PAYPO_SIGNATURE);
        }

        throw new InvalidRequestException('There is no ' . self::X_PAYPO_SIGNATURE . ' header present in request');
    }


    private function verifySignature($signature, Request $request): bool
    {
        $payload =  json_decode(trim($this->httpRequest->getContent()), true);
        $json = json_encode($payload, JSON_UNESCAPED_SLASHES |
        JSON_UNESCAPED_UNICODE);
        $endpoint = $request->server->get('DOCUMENT_URI');
        $data = self::REQUST_METHOD . "+" . $endpoint . "+" . $json;
        $hash = base64_encode(hash_hmac('sha256', $data, $this->data->getClientSecret(), true));

        return $signature === $hash;
    }

    public function getTransactionReference()
    {
        if (isset($this->getData()->referenceId) && !empty($this->getData()->referenceId)) {
            return (string) $this->getData()->referenceId;
        } else {
            throw new InvalidRequestException("PayPo data is missing");
        }
    }

    public function getTransactionStatus()
    {
        if ($this->getData()
            && isset($this->getData()->transactionStatus)
            && !empty($this->getData()->transactionStatus)
        ) {
            return  $this->getData()->transactionStatus;
        } else {
            throw new InvalidRequestException("PayPo data is missing");
        }
    }

    public function getMessage()
    {
        return $this->getData();
    }

    public function getTransactionId()
    {
        if ($this->getData()
            && isset($this->getData()->transactionId)
            && !empty($this->getData()->transactionId)
        ) {
            return  $this->getData()->transactionId;
        } else {
            throw new InvalidRequestException("PayPo data is missing");
        }
    }

    public function getLastUpdate()
    {
        if ($this->getData()
            && isset($this->getData()->lastUpdate)
            && !empty($this->getData()->lastUpdate)
        ) {
            return  $this->getData()->lastUpdate;
        } else {
            throw new InvalidRequestException("PayPo data is missing");
        }
    }

    public function getAmount():float
    {
        if ($this->getData()
            && isset($this->getData()->amount)
            && !empty($this->getData()->amount)
        ) {
            return  ((int)$this->getData()->amount / 100);
        } else {
            throw new InvalidRequestException("PayPo data is missing");
        }
    } 
}