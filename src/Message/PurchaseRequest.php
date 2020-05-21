<?php

namespace Omnipay\Privatbankar\Message;

use Omnipay\Privatbankar\Core\Message\AbstractRequest;

class PurchaseRequest extends AbstractRequest
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
        $this->validate('transactionId', 'paymentMethod', 'payer', 'cartItems', 'source');
        return [
            'id' => $this->getTransactionId(),
            'source' => $this->getParameter('source'),
            'methods' => [$this->getPaymentMethod()],
            'payer' => $this->getPayer(),
            'items' => $this->getCartItems(),
        ];
    }

    public function sendData($data)
    {
        $httpResponse = $this->httpClient->request(
            'POST',
            $this->getParameter('apiUrl') . '/api/create-transaction',
            [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            http_build_query($data)
        );

        $purchaseResponseData = json_decode($httpResponse->getBody()->getContents(), true);
        return new PurchaseResponse($this, $purchaseResponseData);
    }
}
