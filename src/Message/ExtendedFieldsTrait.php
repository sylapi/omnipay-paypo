<?php

namespace Omnipay\PayPo\Message;

trait ExtendedFieldsTrait {

    public function getName()
    {
        return $this->getParameter('name');
    }

    public function setName($value)
    {
        return $this->setParameter('name', $value);
    }
    

    public function getSurname()
    {
        return $this->getParameter('surname');
    }
    
    public function setSurname($value)
    {
        return $this->setParameter('surname', $value);
    }

    public function getBillingAddress()
    {
        return $this->getParameter('billingAddress');
    }

    public function setBillingAddress($value)
    {
        return $this->setParameter('billingAddress', $value);
    }

    public function getShippingAddress()
    {
        return $this->getParameter('shippingAddress');
    }

    public function setShippingAddress($value)
    {
        return $this->setParameter('shippingAddress', $value);
    }

    public function getEmail()
    {
        return $this->getParameter('email');
    }
    
        
    public function setEmail($value)
    {
        return $this->setParameter('email', $value);
    }

    public function getPhone()
    {
        return $this->getParameter('phone');
    }

    public function setPhone($value)
    {
        return $this->setParameter('phone', $value);
    }

    public function getShipment()
    {
        return $this->getParameter('shipment');
    }
    
    public function setShipment($value)
    {
        return $this->setParameter('shipment', $value);
    }

    /**
     * Get the card token.
     *
     * @return string
     */
    public function getToken()
    {
        return $this->getParameter('token');
    }

    /**
     * Sets the card token.
     *
     * @param string $value
     * @return $this
     */
    public function setToken($value)
    {
        return $this->setParameter('token', $value);
    }

    public function getShopId()
    {
        return $this->getParameter('shopId');
    }

    public function setShopId($value)
    {
        return $this->setParameter('shopId', $value);
    }

    public function getPosId()
    {
        return $this->getParameter('posId');
    }

    public function setPosId($posId)
    {
        return $this->setParameter('posId', $posId);
    }

    public function getClientSecret()
    {
        return $this->getParameter('clientSecret');
    }

    public function setClientSecret($clientSecret)
    {
        return $this->setParameter('clientSecret', $clientSecret);
    }

    public function getApiUrl()
    {
        if ($this->getTestMode()) {
            return 'https://api.sandbox.paypo.pl/v3';
        } else {
            return 'https://api.sandbox.paypo.pl/v3';
        }
    }

    public function setApiUrl($apiUrl)
    {
        $this->setParameter('apiUrl', $apiUrl);
    }


    public function getHeaders(array $append = [])
    {
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        return array_merge($headers,$append);
    }
    
}