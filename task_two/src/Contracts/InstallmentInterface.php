<?php

namespace Insly\Calculator\Contracts;

interface InstallmentInterface
{
    /**
     * Get base price
     * 
     * @return float
     */
    public function getBasePriceAmount();

    /**
     * Get commission
     * 
     * @return float
     */
    public function getCommissionAmount();

    /**
     * Get tax
     * 
     * @return float
     */
    public function getTaxAmount();

    /**
     * Get grand total
     * @return float
     */
    public function getGrandTotalAmount();
}