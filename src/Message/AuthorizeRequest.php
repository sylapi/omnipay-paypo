<?php

namespace Omnipay\PayPo\Message;

use Exception;
use GuzzleHttp\Psr7;
use Omnipay\PayPo\Message\AbstractRequest;
use Omnipay\PayPo\Message\AuthorizeResponse;


class AuthorizeRequest extends AbstractRequest
{
    const API_PATH = '/oauth/tokens';

    public function sendData($data)
    {
        try{
            $body = Psr7\Utils::streamFor(http_build_query($this->getData()));
            $result =  $this->httpClient->request(
                'POST',
                $this->getApiUrl() . self::API_PATH,
                $this->getHeaders(),
                $body
            );
            $response = json_decode($result->getBody(), true);

            return new AuthorizeResponse($this, $response);

        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * @return array
     */
    public function getData()
    {
        return [
            'grant_type' => 'client_credentials',
            'client_id' => $this->getPosId(),
            'client_secret' => $this->getClientSecret()
        ];
    }
}
