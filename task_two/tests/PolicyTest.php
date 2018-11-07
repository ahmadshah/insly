<?php

namespace Insly\Calculator\TestCase;

use Insly\Calculator\Policy;
use PHPUnit\Framework\TestCase;

class PolicyTest extends TestCase
{
    /**
     * Policy instance
     * 
     * @var Insly\Calculator\Contracts\Policy
     */
    protected $stub;

    public function setUp()
    {
        $this->stub = new Policy(1100.0, 187.0, 110.0);
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
        $this->assertSame(1100.0, $this->stub->getBasePriceAmount());
    }

    /**
     * @test
     */
    public function testGetCommissionAmount()
    {
        $this->assertSame(187.0, $this->stub->getCommissionAmount());
    }

    /**
     * @test
     */
    public function testGetTaxAmount()
    {
        $this->assertSame(110.0, $this->stub->getTaxAmount());
    }

    /**
     * @test
     */
    public function testGetGrandTotalAmount()
    {
        $this->assertSame(1397.0, $this->stub->getGrandTotalAmount());
    }
}