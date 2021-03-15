<?php

namespace Omnipay\Privatbankar;

use Omnipay\Common\AbstractGateway;
use Omnipay\Privatbankar\Message\PurchaseRequest;
use Omnipay\Privatbankar\Message\ChargeRequest;

class Gateway extends AbstractGateway
{
    protected const URL_SANDBOX = 'http://payment.dev2.innobotics.hu';
    protected const URL_PRODUCTION = 'https://fizetes.privatbankar.hu';

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
        $this->setParameter(
            'apiUrl',
            $this->getTestMode() ? self::URL_SANDBOX : self::URL_PRODUCTION
        );
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }

    public function charge(array $parameters = array())
    {
        return $this->createRequest(ChargeRequest::class, $parameters);
    }
}
