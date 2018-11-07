<?php

namespace Insly\Calculator\Contracts;

interface PolicyInterface
{
    public function getBasePriceAmount();

    public function getCommissionAmount();

    public function getTaxAmount();

    public function getGrandTotalAmount();
}