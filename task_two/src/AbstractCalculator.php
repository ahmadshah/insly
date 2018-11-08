<?php

namespace Insly\Calculator;

use DateTime;
use Insly\Calculator\Exceptions\OutOfRangeException;

abstract class AbstractCalculator
{
    /**
     * Submission date
     * 
     * @var DateTime
     */
    protected $submissionDate;

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
     * 
     * @var int
     */
    protected $numberOfPayments = 1;

    /**
     * Policy instance
     * 
     * @var Insly\Calculator\Contracts\PolicyInterface
     */
    protected $policy;

    /**
     * Installments calculated.
     * 
     * @var array
     */
    protected $installments = [];

    /**
     * Set submission date
     * 
     * @param DateTime $dateTime
     * 
     * @return Insly\Calculator\AbstractCalculator
     */
    public function setSubmissionDate(DateTime $dateTime)
    {
        $this->submissionDate = $dateTime;

        return $this;
    }

    /**
     * Get submission date
     * 
     * @return DateTime
     */
    public function getSubmissionDate()
    {
        return $this->submissionDate;
    }

    /**
     * Set base price percentage rate
     * 
     * @param int $value
     * 
     * @return Insly\Calculator\AbstractCalculator
     */
    public function setBasePrice(int $value)
    {
        $this->basePrice = $value;

        return $this;
    }

    /**
     * Get base price percentage rate
     * 
     * @return int
     */
    public function getBasePrice()
    {
        return $this->basePrice;
    }

    /**
     * Get commission percentage rate
     * 
     * @return int
     */
    public function getCommission()
    {
        return $this->commission;
    }

    /**
     * Set car estimated value
     * 
     * @param int $value
     * 
     * @return Insly\Calculator\AbstractCalculator
     */
    public function setCarValue(int $value)
    {
        if ($value < 100 || $value > 100000) {
            throw new OutOfRangeException('Car value must be between 100 and 100000');
        }

        $this->carValue = $value;

        return $this;
    }

    /**
     * Get car estimated value
     * 
     * @return int
     */
    public function getCarValue()
    {
        return $this->carValue;
    }

    /**
     * Set tax value
     * 
     * @param int $value
     * 
     * @return Insly\Calculator\AbstractCalculator
     */
    public function setTax(int $value)
    {
        if ($value > 100) {
            throw new OutOfRangeException('Tax value must not be higher than 100%');
        }

        $this->tax = $value;

        return $this;
    }

    /**
     * Get tax value
     * 
     * @return int
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * Get number of payments to be made by the customer
     * 
     * @return int
     */
    public function getNumberOfPayments()
    {
        return $this->numberOfPayments;
    }

    /**
     * Set number of payments to be made by the customer
     * 
     * @param int $value
     * 
     * @return Insly\Calculator\AbstractCalculator
     */
    public function setNumberOfPayments(int $value)
    {
        if ($value < 1 || $value > 12) {
            throw new OutOfRangeException('Number of payments must be between 1 and 12');
        }

        $this->numberOfPayments = $value;

        return $this;
    }

    /**
     * Set policy
     * 
     * @param float $basePrice
     * @param float $commission
     * @param float $tax
     * 
     * @return Insly\Calculator\AbstractCalculator
     */
    public function setPolicy(float $basePrice, float $commission, float $tax)
    {
        $this->policy = new Policy($basePrice, $commission, $tax);

        return $this;
    }

    /**
     * Get policy
     * 
     * @return Insly\Calculator\Contracts\PolicyInterface
     */
    public function getPolicy()
    {
        return $this->policy;
    }

    /**
     * Get installments
     * 
     * @return array
     */
    public function getInstallments()
    {
        return $this->installments;
    }

    /**
     * Add installments
     * 
     * @param float $basePrice
     * @param float $commission
     * @param float $tax
     * @param boolean $first
     * 
     * @return Insly\Calculator\AbstractCalculator
     */
    public function addInstallment(float $basePrice, float $commission, float $tax, $first = false)
    {
        $this->installments[] = new Installment($basePrice, $commission, $tax);

        if($first) {
            unset($this->installments[0]);
            $this->installments = array_reverse($this->installments);
        }

        return $this;
    }

    /**
     * Calculate installments
     * 
     * @return Insly\Calculator\AbstractCalculator
     */
    abstract public function calculate();
}