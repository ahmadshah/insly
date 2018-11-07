<?php

namespace Insly\Calculator\TestCase;

use PHPUnit\Framework\TestCase;
use Insly\Calculator\Installment;

class InstallmentTest extends TestCase
{
    protected $stub;

    public function setUp()
    {
        $this->stub = new Installment(10000, 10, 2);
    }

    public function testCanGetAndSetBasePrice()
    {
        $this->assertSame(11, $this->stub->getBasePrice());

        $this->stub->setBasePrice(13);
        $this->assertSame(13, $this->stub->getBasePrice());
    }

    public function testCanGetCommission()
    {
        $this->assertSame(17, $this->stub->getCommission());
    }

    public function testCanGetCarValue()
    {
        $this->assertSame(10000, $this->stub->getCarValue());
    }

    public function testCanReplaceCarValue()
    {
        $this->stub->setCarValue(100000);

        $this->assertSame(100000, $this->stub->getCarValue());
    }

    public function testCanGetTaxAmount()
    {
        $this->assertSame(10, $this->stub->getTax());
    }

    public function testCanReplaceTaxAmount()
    {
        $this->stub->setTax(100);

        $this->assertSame(100, $this->stub->getTax());
    }

    public function testCanGetNumberOfPayments()
    {
        $this->assertSame(2, $this->stub->getNumberOfPayments());
    }

    public function testCanReplaceNumberOfPayments()
    {
        $this->stub->setNumberOfPayments(1);

        $this->assertSame(1, $this->stub->getNumberOfPayments());
    }

    public function testGetAndSetBasePriceAmount()
    {
        $this->stub->calculate();

        $this->assertSame(1100, $this->stub->getBasePriceAmount());
    }

    public function testGetAndSetCommissionAmount()
    {
        $this->stub->calculate();

        $this->assertSame(187, $this->stub->getCommissionAmount());
    }

    public function testGetAndSetTaxAmount()
    {
        $this->stub->calculate();

        $this->assertSame(110, $this->stub->getTaxAmount());
    }

    public function testCanGetInstallments()
    {   
        $this->stub->calculate();

        $this->assertSame([], $this->stub->getInstallments());
    }
}
