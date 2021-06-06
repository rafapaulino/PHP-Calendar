<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Calendar\DaysWeek;

class DaysWeekTest extends TestCase 
{
    protected DaysWeek $days;

    protected function setUp() :void
    {
        $this->days = new DaysWeek;
    }

    public function testInstance() :void
    {
        $this->assertInstanceOf(DaysWeek::class, $this->days);
    }

    public function testTotalOfDays() :void
    {
        $result = $this->days->getDays();
        $this->assertCount(7, $result);
    }

    public function testContent() :void
    {
        $result = $this->days->getDays();
        $this->assertIsArray($result->all());
    }

    public function testObject() :void
    {
        $result = $this->days->getDays();
        $this->assertIsObject($result->first());
    }

    public function testString() :void
    {
        $result = $this->days->getDays();
        $first = $result->first();
        $this->assertIsString($first->letter);
    }

    public function testHasKey() :void
    {
        $result = $this->days->getDays();
        $this->assertArrayHasKey(rand(0,6), $result->all());
    }

    public function testFirstDay() :void
    {
        $result = $this->days->getDays();
        $this->assertArrayHasKey(0, $result->all());
    }

    public function testSecondDay() :void
    {
        $result = $this->days->getDays();
        $this->assertArrayHasKey(1, $result->all());
    }

    public function testThirdDay() :void
    {
        $result = $this->days->getDays();
        $this->assertArrayHasKey(2, $result->all());
    }

    public function testFourthDay() :void
    {
        $result = $this->days->getDays();
        $this->assertArrayHasKey(3, $result->all());
    }

    public function testFifthDay() :void
    {
        $result = $this->days->getDays();
        $this->assertArrayHasKey(4, $result->all());
    }

    public function testSixthDay() :void
    {
        $result = $this->days->getDays();
        $this->assertArrayHasKey(5, $result->all());
    }

    public function testSeventhDay() :void
    {
        $result = $this->days->getDays();
        $this->assertArrayHasKey(6, $result->all());
    }
}