<?php

declare(strict_types = 1);

namespace Payum\LaravelPackage\Model;

use Illuminate\Database\Eloquent\Model;
use Payum\Core\Model\CreditCardInterface;
use Payum\Core\Model\PaymentInterface;

class Payment extends Model implements PaymentInterface
{
    protected $creditCard;

    /**
     * @var string
     */
    protected $table = 'payum_payments';

    public function setDetails($details)
    {
        $this->setAttribute('details', json_encode($details ?: [], JSON_PRESERVE_ZERO_FRACTION));
    }

    public function getDetails()
    {
        return json_decode($this->getAttribute('details') ?: '{}', true);
    }

    public function getNumber()
    {
        return $this->getAttribute('number');
    }

    public function setNumber($number)
    {
        $this->setAttribute('number', $number);
    }

    public function getDescription()
    {
        return $this->getAttribute('description');
    }

    public function setDescription($description)
    {
        $this->setAttribute('description', $description);
    }

    public function getClientEmail()
    {
        // TODO: Implement getClientEmail() method.
    }

    public function setClientEmail($clientEmail)
    {
        $this->setAttribute('clientEmail', $clientEmail);
    }

    public function getClientId()
    {
        return $this->getAttribute('clientId');
    }

    public function setClientId($clientId)
    {
        $this->setAttribute('clientId', $clientId);
    }

    public function getTotalAmount()
    {
        return $this->getAttribute('totalAmount');
    }

    public function setTotalAmount($totalAmount)
    {
        $this->setAttribute('totalAmount', $totalAmount);
    }

    public function getCurrencyCode()
    {
        return $this->getAttribute('currencyCode');
    }

    public function setCurrencyCode($currencyCode)
    {
        $this->setAttribute('currencyCode', $currencyCode);
    }

    public function getCreditCard()
    {
        return $this->creditCard;
    }

    public function setCreditCard(CreditCardInterface $creditCard = null)
    {
        $this->creditCard = $creditCard;
    }
}
