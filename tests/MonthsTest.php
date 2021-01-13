<?php declare(strict_types=1);

namespace Tests\Calendar;

use PHPUnit\Framework\TestCase;
use Calendar\Months;

class MonthsTest extends TestCase 
{
    protected $months;

    protected function setUp() :void
    {
        $this->months = new Months;
    }

    public function testInstance() :void
    {
        $this->assertInstanceOf(Months::class, $this->months);
    }

    public function testTotalOfDays() :void
    {
        $result = $this->months->getMonths();
        $this->assertCount(12, $result);
    }

    public function testContent() :void
    {
        $result = $this->months->getMonths();
        $this->assertIsArray($result->all());
    }

    public function testObject() :void
    {
        $result = $this->months->getMonths();
        $this->assertIsObject($result->first());
    }

    public function testString() :void
    {
        $result = $this->months->getMonths();
        $first = $result->first();
        $this->assertIsString($first->letter);
    }

    public function testHasKey() :void
    {
        $result = $this->months->getMonths();
        $this->assertArrayHasKey(rand(1,12), $result->all());
    }

    public function testJanuary() :void
    {
        $result = $this->months->getMonths();
        $this->assertArrayHasKey(1, $result->all());
    }

    public function testFebruary() :void
    {
        $result = $this->months->getMonths();
        $this->assertArrayHasKey(2, $result->all());
    }

    public function testMarch() :void
    {
        $result = $this->months->getMonths();
        $this->assertArrayHasKey(3, $result->all());
    }

    public function testApril() :void
    {
        $result = $this->months->getMonths();
        $this->assertArrayHasKey(4, $result->all());
    }

    public function testMay() :void
    {
        $result = $this->months->getMonths();
        $this->assertArrayHasKey(5, $result->all());
    }

    public function testJune() :void
    {
        $result = $this->months->getMonths();
        $this->assertArrayHasKey(6, $result->all());
    }

    public function testJuly() :void
    {
        $result = $this->months->getMonths();
        $this->assertArrayHasKey(7, $result->all());
    }

    public function testAugust() :void
    {
        $result = $this->months->getMonths();
        $this->assertArrayHasKey(8, $result->all());
    }

    public function testSeptember() :void
    {
        $result = $this->months->getMonths();
        $this->assertArrayHasKey(9, $result->all());
    }

    public function testOctober() :void
    {
        $result = $this->months->getMonths();
        $this->assertArrayHasKey(10, $result->all());
    }

    public function testNovember() :void
    {
        $result = $this->months->getMonths();
        $this->assertArrayHasKey(11, $result->all());
    }

    public function testDecember() :void
    {
        $result = $this->months->getMonths();
        $this->assertArrayHasKey(12, $result->all());
    }
}