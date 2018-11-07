<?php

namespace Insly\Calculator;

class Installment implements Contracts\InstallmentInterface
{
    /**
     * Base Price
     * 
     * @var float
     */
    protected $basePrice;

    /**
     * Commission
     * 
     * @var float
     */
    protected $commission;

    /**
     * Tax
     * 
     * @var float
     */
    protected $tax;

    /**
     * Grand total
     * 
     * @var float
     */
    protected $grandTotal;

    /**
     * Initialize installment instance
     * 
     * @param float $basePrice
     * @param float $commission
     * @param float $tax
     */
    public function __construct(float $basePrice, float $commission, float $tax)
    {
        $this->basePrice = $basePrice;
        $this->commission = $commission;
        $this->tax = $tax;
        $this->grandTotal = $this->caclculatedGrandTotal($basePrice, $commission, $tax);
    }

    /**
     * Get base price
     * 
     * @return float
     */
    public function getBasePriceAmount()
    {
        return $this->basePrice;
    }

    /**
     * Get commission
     * 
     * @return float
     */
    public function getCommissionAmount()
    {
        return $this->commission;
    }

    /**
     * Get tax
     * 
     * @return float
     */
    public function getTaxAmount()
    {
        return $this->tax;
    }

    /**
     * Get grand total
     * @return float
     */
    public function getGrandTotalAmount()
    {
        return $this->grandTotal;
    }

    /**
     * Calculate grand total amount
     * 
     * @param float $basePrice
     * @param float $commission
     * @param float $tax
     * 
     * @return float
     */
    protected function caclculatedGrandTotal(float $basePrice, float $commission, float $tax)
    {
        return $basePrice + $commission + $tax;
    }
}