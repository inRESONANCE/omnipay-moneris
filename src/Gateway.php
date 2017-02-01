<?php

namespace Omnipay\Moneris;

use Omnipay\Common\AbstractGateway;


class Gateway extends AbstractGateway
{
  public function getName()
  {
    return 'Moneris';
  }

  public function getDefaultParameters()
  {
    return array(
      'hpp_id' => '',
      'hpp_key' => '',
      'testMode' => false,
    );
  }

  public function getHppId()
  {
    return $this->getParameter('hpp_id');
  }

  public function setHppId($value)
  {
    return $this->setParameter('hpp_id', $value);
  }

  public function getHppKey()
  {
    return $this->getParameter('hpp_key');
  }

  public function setHppKey($value)
  {
    return $this->setParameter('hpp_key', $value);
  }

  public function purchase(array $parameters = array())
  {
    return $this->createRequest('\Omnipay\Moneris\Message\PurchaseRequest', $parameters);
  }

  public function completePurchase(array $parameters = array())
  {
    return $this->createRequest('\Omnipay\Moneris\Message\CompletePurchaseRequest', $parameters);
  }

}
