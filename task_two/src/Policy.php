<?php

namespace Insly\Calculator;

class Policy implements Contracts\PolicyInterface
{
    protected $basePrice;

    protected $commission;

    protected $tax;

    protected $grandTotal;

    public function __construct(float $basePrice, float $commission, float $tax)
    {
        $this->basePrice = $basePrice;
        $this->commission = $commission;
        $this->tax = $tax;
        $this->grandTotal = $this->caclculatedGrandTotal($basePrice, $commission, $tax);
    }

    public function getBasePriceAmount()
    {
        return $this->basePrice;
    }

    public function getCommissionAmount()
    {
        return $this->commission;
    }

    public function getTaxAmount()
    {
        return $this->tax;
    }

    public function getGrandTotalAmount()
    {
        return $this->grandTotal;
    }

    protected function caclculatedGrandTotal(float $basePrice, float $commission, float $tax)
    {
        return $basePrice + $commission + $tax;
    }
}