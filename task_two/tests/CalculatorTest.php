<?php

namespace Insly\Calculator\TestCase;

use DateTime;
use PHPUnit\Framework\TestCase;
use Insly\Calculator\Calculator;
use Insly\Calculator\Contracts\PolicyInterface;
use Insly\Calculator\Contracts\InstallmentInterface;

class CalculatorTest extends TestCase
{
    /**
     * Calculator instance
     * 
     * @var Insly\Calculator\AbstractCalculator
     */
    protected $stub;

    public function setUp()
    {
        $this->stub = new Calculator(10000, 10, 1);
    }

    public function tearDown()
    {
        $this->stub = null;
    }
    
    /**
     * @expectedException Insly\Calculator\Exceptions\OutOfRangeException
     */
    public function testCarValueOutOfRangeException()
    {
        $this->stub->setCarValue(0);
    }

    /**
     * @expectedException Insly\Calculator\Exceptions\OutOfRangeException
     */
    public function testTaxOutOfRangeException()
    {
        $this->stub->setTax(101);
    }

    /**
     * @expectedException Insly\Calculator\Exceptions\OutOfRangeException
     */
    public function testNumberOfPaymentOutOfRangeException()
    {
        $this->stub->setNumberOfPayments(13);
    }

    /**
     * @test
     */
    public function testCanGetAndSetSubmissionDate()
    {
        $this->assertInstanceOf(DateTime::class, $this->stub->getSubmissionDate());
    }

    /**
     * @test
     */
    public function testCanGetAndSetBasePrice()
    {
        $this->assertSame(11, $this->stub->getBasePrice());

        $this->stub->setBasePrice(13);
        $this->assertSame(13, $this->stub->getBasePrice());
    }

    /**
     * @test
     */
    public function testCanGetCommission()
    {
        $this->assertSame(17, $this->stub->getCommission());
    }

    /**
     * @test
     */
    public function testCanGetCarValue()
    {
        $this->assertSame(10000, $this->stub->getCarValue());
    }

    /**
     * @test
     */
    public function testCanReplaceCarValue()
    {
        $this->stub->setCarValue(100000);

        $this->assertSame(100000, $this->stub->getCarValue());
    }

    /**
     * @test
     */
    public function testCanGetTaxAmount()
    {
        $this->assertSame(10, $this->stub->getTax());
    }

    /**
     * @test
     */
    public function testCanReplaceTaxAmount()
    {
        $this->stub->setTax(100);

        $this->assertSame(100, $this->stub->getTax());
    }

    /**
     * @test
     */
    public function testCanGetNumberOfPayments()
    {
        $this->assertSame(1, $this->stub->getNumberOfPayments());
    }

    /**
     * @test
     */
    public function testCanReplaceNumberOfPayments()
    {
        $this->stub->setNumberOfPayments(1);

        $this->assertSame(1, $this->stub->getNumberOfPayments());
    }

    /**
     * @test
     */
    public function testApplySurgeRateBasePrice()
    {
        $this->stub->setSubmissionDate(new DateTime('2018-11-02 15:01:00'))
            ->calculate();

        $this->assertSame(Calculator::SURGE_RATE, $this->stub->getBasePrice());
    }

    /**
     * @test
     */
    public function testApplyNormalRateBasePrice()
    {
        $this->stub->setSubmissionDate(new DateTime('2018-11-02 20:01:00'))
            ->calculate();

        $this->assertSame(11, $this->stub->getBasePrice());
    }

    /**
     * @test
     */
    public function testCanGetAndSetPolicy()
    {
        $this->stub->calculate();

        $this->assertInstanceOf(PolicyInterface::class, $this->stub->getPolicy());
    }

    /**
     * @test
     */
    public function testCanGetAndSetInstallment()
    {
        $this->stub->calculate();

        $this->assertContainsOnlyInstancesOf(InstallmentInterface::class, $this->stub->getInstallments());
    }

    /**
     * @test
     */
    public function testCanGetAndSetMultipleInstallments()
    {
        $this->stub->setNumberOfPayments(2)->calculate();

        $this->assertContainsOnlyInstancesOf(InstallmentInterface::class, $this->stub->getInstallments());
    }
}
