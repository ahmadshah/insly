<?php

namespace Insly\Calculator\TestCase;

use PHPUnit\Framework\TestCase;
use Insly\Calculator\Installment;

class InstallmentTest extends TestCase
{
    /**
     * Policy instance
     * 
     * @var Insly\Calculator\Contracts\Policy
     */
    protected $stub;

    public function setUp()
    {
        $this->stub = new Installment(550.0, 93.5, 55.0);
    }

    public function tearDown()
    {
        $this->stub = null;
    }

    /**
     * @test
     */
    public function testGetBasePriceAmount()
    {
        $this->assertSame(550.0, $this->stub->getBasePriceAmount());
    }

    /**
     * @test
     */
    public function testGetCommissionAmount()
    {
        $this->assertSame(93.5, $this->stub->getCommissionAmount());
    }

    /**
     * @test
     */
    public function testGetTaxAmount()
    {
        $this->assertSame(55.0, $this->stub->getTaxAmount());
    }

    /**
     * @test
     */
    public function testGetGrandTotalAmount()
    {
        $this->assertSame(698.5, $this->stub->getGrandTotalAmount());
    }
}