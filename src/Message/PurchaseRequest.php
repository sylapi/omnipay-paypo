<?php

namespace Omnipay\PayPo\Message;

use Exception;
use GuzzleHttp\Psr7;
use Omnipay\PayPo\Helpers;
use Omnipay\PayPo\Message\AbstractRequest;


class PurchaseRequest extends AbstractRequest
{
    const API_PATH = '/transactions';

    public function sendData($data)
    {
        $apiUrl = $this->getApiUrl() . self::API_PATH;
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
            return new PurchaseResponse($this, $response);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), $exception->getCode());
        }
    }

    public function getData()
    {
        $data = [
            'merchantId' => $this->getPosId(),
            'shopId' => $this->getShopId(),
            'order' => [
                'referenceId' => $this->getTransactionReference(),
                'amount' => ((float) $this->getAmount() * 100),
                'description' => $this->getDescription(),
                'additionalInfo' => Helpers\Item::toArray($this->getItems()),
                'shipment' => $this->getShipment(),
                'billingAddress' => $this->getBillingAddress(),
                'shippingAddress' => $this->getShippingAddress(),
            ],
            'customer' => [
                'name' => $this->getName(),
                'surname' => $this->getSurname(),
                'email' => $this->getEmail(),
                'phone' => $this->getPhone()
            ],
            'configuration' => [
                'returnUrl' => $this->getReturnUrl(),
                'cancelUrl' => $this->getCancelUrl(),
                'notifyUrl' => $this->getNotifyUrl()
            ]            

        ];

        return $data;
    }
}
