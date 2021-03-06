<?php

namespace Insly\Calculator;

use DateTime;

class Calculator extends AbstractCalculator
{   
    /**
     * Base price surge rate
     */
    const SURGE_RATE = 13;

    /**
     * Day to implement surge rate
     */
    const SURGE_RATE_DAY = 'Friday';

    /**
     * Time surge rate starts
     */
    const SURGE_RATE_START_TIME = '15:00';

    /**
     * Time surge rate ends
     */
    const SURGE_RATE_END_TIME = '20:00';

    /**
     * Initialize calculator class
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
        $this->setSubmissionDate(new DateTime);
    }

    /**
     * Calculate installments
     * 
     * @return Insly\Calculator\AbstractCalculator
     */
    public function calculate()
    {
        if($this->isSurgeRate($this->getSubmissionDate())) {
            $this->setBasePrice(self::SURGE_RATE);
        }

        //calculate total base price
        $basePrice = $this->calculateBasePrice($this->getCarValue(), $this->getBasePrice());
        //calculate total commission
        $commission = $this->calculateCommission($basePrice, $this->getCommission());
        //caclculate total tax
        $tax = $this->calculateTax($basePrice, $this->getTax());
        //set policy
        $this->setPolicy($basePrice, $commission, $tax);
        //calculate installments
        if ($this->getNumberOfPayments() > 1) {
            $counter = 1;
            while($counter <= $this->getNumberOfPayments()) {
                list($installmentBasePrice, $installmentCommission, $installmentTax) = $this->calculateInstallment($this->getNumberOfPayments(), $basePrice, $commission, $tax);

                $this->addInstallment($installmentBasePrice, $installmentCommission, $installmentTax);
                
                $counter++;
            }

            //Determine if adjustment is needed for the installments
            $installmentsTotal = 0;
            foreach ($this->getInstallments() as $installment) {
                $installmentsTotal += $installment->getGrandTotalAmount();
            }

            if ($this->isAdjustmentNeeded($this->getPolicy()->getGrandTotalAmount(), $installmentsTotal)) {
                $policy = $this->getPolicy();
                $numberOfInstallments = $this->getNumberOfPayments();
                $installments = $this->getInstallments();
                unset($installments[$numberOfInstallments-1]);                

                list($basePrice, $commission, $tax) = $this->adjustLastInstallment($policy, $installments);
                $this->addInstallment($basePrice, $commission, $tax, true);
            }
        } else {
            $this->addInstallment($basePrice, $commission, $tax);
        }

        return $this;
    }

    /**
     * Determine is surge rate applicable
     * 
     * @param DateTime
     * 
     * @return boolean
     */
    protected function isSurgeRate(DateTime $submissionDate)
    {
        $day = $submissionDate->format('l');
        $time = $submissionDate->format('H:i');

        if ($day === self::SURGE_RATE_DAY && $time >= self::SURGE_RATE_START_TIME && $time <= self::SURGE_RATE_END_TIME) {
            return true;
        }

        return false;
    }

    /**
     * Calculate base price amount
     * 
     * @param float $carValue
     * @param float $basePrice
     * 
     * @return float
     */
    protected function calculateBasePrice(float $carValue, float $basePrice)
    {
        return round((float) $carValue * ($basePrice/100), 2);
    }

     /**
     * Calculate commission amount
     * 
     * @param float $basePriceamount
     * @param float $commission
     * 
     * @return float
     */
    protected function calculateCommission(float $basePriceAmount, float $commission)
    {
        return round((float) $basePriceAmount * ($commission/100), 2);
    }

     /**
     * Calculate tax amount
     * 
     * @param float $basePriceAmount
     * @param float $tax
     * 
     * @return float
     */
    protected function calculateTax(float $basePriceAmount, float $tax)
    {
        return round((float) $basePriceAmount * ($tax/100), 2);
    }

    /**
     * Calculate installments for payments more than 1
     * 
     * @param int $numberOfPayments
     * @param float $totalBasePriceAmount
     * @param float $totalCommissionAmount
     * @param $totalTaxAmount
     * 
     * @return array
     */
    protected function calculateInstallment(int $numberOfPayments, float $totalBasePriceAmount, float $totalCommissionAmount, float $totalTaxAmount)
    {
        return [
            round((float) $totalBasePriceAmount/$numberOfPayments, 2),
            round((float) $totalCommissionAmount/$numberOfPayments, 2),
            round((float) $totalTaxAmount/$numberOfPayments, 2)
        ];
    }

    /**
     * Determine if adjustment is need to match the policy grand total
     * 
     * @param float $grandTotal
     * @param float $installmentsTotal
     * 
     * @return boolean
     */
    protected function isAdjustmentNeeded(float $grandTotal, float $installmentsTotal)
    {
        if($installmentsTotal > $grandTotal) {
            return true;
        }

        if($grandTotal > $installmentsTotal) {
            return true;
        }

        return false;
    }

    /**
     * Adjust the last installment
     * 
     * @param Insly\Calculator\Contracts\PolicyInterface $policy
     * @param array $installments
     * 
     * @return array
     */
    protected function adjustLastInstallment(Policy $policy, array $installments)
    {
        $total = 0;
        $totalCommission = 0;
        $totalTax = 0;

        foreach($installments as $installment) {
            $total += $installment->getBasePriceAmount();
            $totalCommission += $installment->getCommissionAmount();
            $totalTax += $installment->getTaxAmount();
        }

        return [
            $policy->getBasePriceAmount() - $total,
            $policy->getCommissionAmount() - $totalCommission,
            $policy->getTaxAmount() - $totalTax
        ];
    }
}