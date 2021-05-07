<?php

namespace Omnipay\PayPo\Message;

use Exception;
use Omnipay\PayPo\Message\AbstractRequest;

class FetchTransactionRequest extends AbstractRequest
{
    const API_PATH = '/transactions';

    public function sendData($data)
    {
        $apiUrl = $this->getApiUrl() . self::API_PATH . '/'. $this->getTransactionId();

        $headers = $this->getHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '. $this->getToken()
        ]);
        try {
            $result = $this->httpClient->request(
                'GET', 
                $apiUrl, 
                $headers
            );

            $response = json_decode($result->getBody(), true);
            $this->response = $response;
            return new FetchTransactionResponse($this, $response);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), $exception->getCode());
        }
    }

    public function getData()
    {
        return [];
    }

    public function getTransactionId()
    {
        return $this->getParameter('transactionId');
    }

    public function setTransactionId($value)
    {
        return $this->setParameter('transactionId', $value);
    }

}
