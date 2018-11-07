<?php

namespace Insly\Calculator;

class Installment extends Calculator
{
    /**
     * Initialize installment calss
     * 
     * @param int $carValue
     * @param int $taxAmount
     * @param int $numberOfPayments
     */
    public function __construct(int $carValue, int $taxAmount, int $numberOfPayments)
    {
        $this->setCarValue($carValue);
        $this->setTax($taxAmount);
        $this->setNumberOfPayments($numberOfPayments);
    }

    /**
     * Calculate installments
     * 
     * @return Insly\Calculator\Installment
     */
    public function calculate()
    {
        //calculate total base price
        $this->setBasePriceAmount($this->calculateBasePrice($this->getCarValue(), $this->getBasePrice()));
        //calculate total commission
        $this->setCommissionAmount($this->calculateCommission($this->getBasePriceAmount(), $this->getCommission()));
        //caclculate total tax
        $this->setTaxAmount($this->calculateTax($this->getBasePriceAmount(), $this->getTax()));

        if ($this->getNumberOfPayments() > 1) {
            $counter = 1;
            while($counter <= $this->getNumberOfPayments()) {
                list($basePrice, $commission, $tax) = $this->calculateInstallment($this->getNumberOfPayments(), $this->getBasePriceAmount(), $this->getCommissionAmount(), $this->getTaxAmount());

                $this->addInstallment($basePrice, $commission, $tax);
                
                $counter++;
            }
        } else {
            $this->addInstallment($this->getBasePriceAmount(), $this->getCommissionAmount(), $this->getTaxAmount());
        }

        return $this;
    }

    /**
     * Calculate base price amount
     * 
     * @param int $carValue
     * @param int $basePrice
     * 
     * @return int
     */
    protected function calculateBasePrice(int $carValue, int $basePrice) : int
    {
        return $carValue * ($basePrice/100);
    }

     /**
     * Calculate commission amount
     * 
     * @param int $basePriceamount
     * @param int $commission
     * 
     * @return int
     */
    protected function calculateCommission(int $basePriceAmount, int $commission) : int
    {
        return $basePriceAmount * ($commission/100);
    }

     /**
     * Calculate tax amount
     * 
     * @param int $basePriceAmount
     * @param int $tax
     * 
     * @return int
     */
    protected function calculateTax(int $basePriceAmount, int $tax) : int
    {
        return $basePriceAmount * ($tax/100);
    }

    protected function calculateInstallment(int $numberOfPayments, int $totalBasePriceAmount, int $totalCommissionAmount, int $totalTaxAmount)
    {
        return [
            $totalBasePriceAmount/$numberOfPayments,
            $totalCommissionAmount/$numberOfPayments,
            $totalTaxAmount/$numberOfPayments
        ];
    }
}