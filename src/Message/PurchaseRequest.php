<?php

namespace Omnipay\Moneris\Message;

/**
 * Moneris Purchase Request
 */
class PurchaseRequest extends AbstractRequest
{

    public function getData()
    {
        $this->validate('amount');

        $data = array();
        $data['hpp_id'] = $this->getHppId();
        $data['hpp_key'] = $this->getHppKey();
        $data['amount'] = $this->getAmount();
        $data['order_no'] = $this->getTransactionId();

        $card = $this->getCard();
        if ($card) {
          $data['od_bill_firstname'] = $card->getFirstName();
          $data['od_bill_lastname'] = $card->getLastName();
          $data['od_bill_address'] = $card->getAddress1() . ' ' . $card->getAddress2();
          $data['od_bill_city'] = $card->getCity();
          $data['od_bill_state'] = $card->getState();
          $data['od_bill_country'] = $card->getCountry();
          $data['od_bill_zipcode'] = $card->getPostcode();
          $data['od_bill_phone'] = $card->getPhone();

          $data['od_ship_firstname'] = $card->getShippingFirstName();
          $data['od_ship_lastname'] = $card->getShippingLastName();
          $data['od_ship_address'] = $card->getShippingAddress1() . ' ' . $card->getShippingAddress2();
          $data['od_ship_city'] = $card->getShippingCity();
          $data['od_ship_state'] = $card->getShippingState();
          $data['od_ship_country'] = $card->getShippingCountry();
          $data['od_ship_zipcode'] = $card->getShippingPostcode();
          $data['od_ship_phone'] = $card->getShippingPhone();

          $data['client_email'] = $card->getEmail();
        }

        $data = array_merge($data, $this->getItemData());

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}