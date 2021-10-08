<?php

namespace Omnipay\PayPo\Message;

use Exception;
use GuzzleHttp\Psr7;
use Omnipay\PayPo\Message\AbstractRequest;

class RefundRequest extends AbstractRequest
{
    const API_PATH = '/transactions';

    public function sendData($data)
    {
        $apiUrl = $this->getApiUrl() . self::API_PATH . '/'. $this->getTransactionId().'/refunds';

        $headers = $this->getHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '. $this->getToken()
        ]);
        try {
            $body = Psr7\Utils::streamFor(json_encode($data));
            $result = $this->httpClient->request(
                'POST', 
                $apiUrl, 
                $headers,
                $body
            );

            $response = json_decode($result->getBody(), true);
            $this->response = $response;
            return new RefundResponse($this, $response);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), $exception->getCode());
        }
    }

    public function getData()
    {
        return [
            'amount' =>  (int) round($this->getAmount() * 100),
        ];
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
