<?php

namespace Omnipay\Moneris\Message;

use Guzzle\Http\ClientInterface;
use Omnipay\Common\CreditCard;
use Omnipay\Common\Currency;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Exception\RuntimeException;
use Omnipay\Common\Helper;
use Omnipay\Common\ItemBag;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Moneris Abstract Request
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{

  protected $liveEndpoint = 'https://esplus.moneris.com/DPHPP/index.php';
  protected $testEndpoint = 'https://esplusqa.moneris.com/DPHPP/index.php';

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

  public function getEndpoint()
  {
    return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
  }

  /**
   * A list of items in this order
   *
   * @return ItemBag|null A bag containing items in this order
   */
  public function getItems()
  {
    return $this->getParameter('items');
  }

  /**
   * Set the items in this order
   *
   * @param ItemBag|array $items An array of items in this order
   */
  public function setItems($items)
  {
    if ($items && !$items instanceof ItemBag) {
      $items = new ItemBag($items);
    }

    return $this->setParameter('items', $items);
  }

  protected function getItemData()
  {
    $data = array();
    $items = $this->getItems();
    if ($items) {
      foreach ($items as $n => $item) {
        $data["li_id$n"] = $n;
        $data["li_description$n"] = $item->getName();
        $data["li_quantity$n"] = $item->getQuantity();
        $data["li_price$n"] = $item->getPrice();
      }
    }

    return $data;
  }

  /**
   * Get the card.
   *
   * @return CreditCard
   */
  public function getCard()
  {
    return $this->getParameter('card');
  }

  /**
   * Sets the card.
   *
   * @param CreditCard $value
   * @return AbstractRequest Provides a fluent interface
   */
  public function setCard($value)
  {
    if ($value && !$value instanceof CreditCard) {
      $value = new CreditCard($value);
    }

    return $this->setParameter('card', $value);
  }
}
