<?php

namespace Omnipay\Privatbankar;

use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
    protected const URL_SANDBOX = 'http://payment.dev2.innobotics.hu';
    protected const URL_PRODUCTION = 'http://payment.dev2.innobotics.hu'; // TODO: get production endpoint

    public function getName()
    {
        return 'Privatbankar';
    }

    public function initialize(array $parameters = array())
    {
        parent::initialize($parameters);
        $this->setApiUrl();
        return $this;
    }

    public function getDefaultParameters()
    {
        return [];
    }

    public function setSource($value)
    {
        $this->setParameter('source', $value);
    }

    public function setApiUrl()
    {
        if ($this->getTestMode()) {
            $apiUrl = self::URL_SANDBOX;
        } else {
            $apiUrl = self::URL_PRODUCTION;
        }

        $this->setParameter('apiUrl', $apiUrl);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest(\Omnipay\Privatbankar\Message\PurchaseRequest::class, $parameters);
    }

    public function charge(array $parameters = array())
    {
        return $this->createRequest(\Omnipay\Privatbankar\Message\ChargeRequest::class, $parameters);
    }
}
