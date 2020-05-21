<?php

namespace Omnipay\Privatbankar\Message;

use Omnipay\Privatbankar\Core\Message\AbstractRequest;

class ChargeRequest extends AbstractRequest
{
    public function setPayer($value)
    {
        $this->setParameter('payer', $value);
        return $this;
    }

    public function getPayer()
    {
        return $this->getParameter('payer');
    }

    public function setCartItems($value)
    {
        $this->setParameter('cartItems', $value);
        return $this;
    }

    public function getCartItems()
    {
        return $this->getParameter('cartItems');
    }

    public function setSource($value)
    {
        $this->setParameter('source', $value);
        return $this;
    }

    public function getData()
    {
        $data = parent::getData();
        $this->validate('transactionReference');
        $data['transactionReference'] = $this->getTransactionReference();
        return $data;
    }

    public function sendData($data)
    {
        $httpResponse = $this->httpClient->request(
            'POST',
            $this->getParameter('apiUrl') . '/api/recurring/pay/' . $data['transactionReference']
        );

        $data = json_decode($httpResponse->getBody()->getContents(), true);
        return new ChargeResponse($this, $data);
    }
}
