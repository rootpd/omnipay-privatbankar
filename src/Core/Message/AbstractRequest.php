<?php

namespace Omnipay\Privatbankar\Core\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    public function setApiUrl($value)
    {
        $this->setParameter('apiUrl', $value);
        return $this;
    }

    public function getData()
    {
        $this->validate('apiUrl');
        return [];
    }

}
