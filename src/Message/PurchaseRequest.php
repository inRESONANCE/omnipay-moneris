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

        $data = array_merge($data, $this->getItemData());

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}