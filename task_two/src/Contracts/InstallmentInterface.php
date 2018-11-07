<?php

namespace Insly\Calculator\Contracts;

interface InstallmentInterface
{
    public function getBasePriceAmount();

    public function getCommissionAmount();

    public function getTaxAmount();

    public function getGrandTotalAmount();
}