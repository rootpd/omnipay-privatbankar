<?php

namespace Omnipay\Privatbankar\Message;

use Omnipay\Common\Message\AbstractResponse;

class ChargeResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return $this->getTransactionStatus() === 'success';
    }

    public function getTransactionId()
    {
        if (!isset($this->data['data']['token'])) {
            return null;
        }
        return $this->data['data']['token'];
    }

    public function getTransactionStatus()
    {
        if (!isset($this->data['status'])) {
            return null;
        }
        return $this->data['status'];
    }

    public function getMessage()
    {
        if (!isset($this->data['message'][0])) {
            return null;
        }
        return $this->data['message'][0];
    }
}
