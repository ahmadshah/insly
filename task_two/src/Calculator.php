<?php

namespace Insly\Calculator;

abstract class Calculator
{
    /**
     * Policy base price from car value.
     * 
     * @var integer
     */
    protected $basePrice = 11;

    /**
     * Commission value that will be added into base price.
     * 
     * @var int
     */
    protected $commission = 17;

    /**
     * Car estimated value (100 - 100,000 EUR).
     * 
     * @var int
     */
    protected $carValue = 0;

    /**
     * Tax amount that will be added into base price (0-100%).
     * 
     * @var int
     */
    protected $tax = 0;

    /**
     * Number of installments (1-12).
     */
    protected $numberOfPayments = 1;

    protected $basePriceAmount;

    protected $commissionAmount;

    protected $taxAmount;

    /**
     * Installments calculated.
     * 
     * @var array
     */
    protected $installments = [];

    public function setBasePrice(int $value)
    {
        $this->basePrice = $value;

        return $this;
    }

    public function getBasePrice() : int
    {
        return $this->basePrice;
    }

    public function getCommission() : int
    {
        return $this->commission;
    }

    public function setCarValue(int $value)
    {
        $this->carValue = $value;

        return $this;
    }

    public function getCarValue() : int
    {
        return $this->carValue;
    }

    public function setTax(int $value)
    {
        $this->tax = $value;

        return $this;
    }

    public function getTax() : int
    {
        return $this->tax;
    }

    public function getNumberOfPayments() : int
    {
        return $this->numberOfPayments;
    }

    public function setNumberOfPayments(int $value)
    {
        $this->numberOfPayments = $value;

        return $this;
    }

    public function getBasePriceAmount() : int
    {
        return $this->basePriceAmount;
    }

    public function setBasePriceAmount(int $value)
    {
        $this->basePriceAmount = $value;

        return $this;
    }

    public function getCommissionAmount() : int
    {
        return $this->commissionAmount;
    }

    public function setCommissionAmount(int $value)
    {
        $this->commissionAmount = $value;

        return $this;
    }

    public function getTaxAmount() : int
    {
        return $this->TaxAmount;
    }

    public function setTaxAmount(int $value)
    {
        $this->TaxAmount = $value;

        return $this;
    }

    public function getInstallments() : array
    {
        return $this->installments;
    }

    public function addInstallment(int $basePrice, int $commission, $tax)
    {
        $this->installments[] = [
            'base_price' => $basePrice,
            'commission' => $commission,
            'tax' => $tax
        ];

        return $this;
    }

    abstract public function calculate();
}