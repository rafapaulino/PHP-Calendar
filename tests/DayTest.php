<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Carbon\Carbon;
use Calendar\Months;
use Calendar\DaysWeek;
use Calendar\Day;

class DayTest extends TestCase
{
    protected Day $day;

    protected function setUp() :void
    {
        $months = new Months;
        $month = $months->getMonths()->all()[1];
        $week = new DaysWeek;
        $week = $week->getDays()[5];

        $date = Carbon::createFromFormat('Y-m-d H:i:s', '2021-01-01 00:00:00');

        $this->day = new Day(
            2021,
            $month,
            1,
            $week,
            $date,
            true
        );
    }

    public function testInstance() :void
    {
        $this->assertInstanceOf(Day::class, $this->day);
    }

    public function testObject() :void
    {
        $result = $this->day->getDay();
        $this->assertIsObject($result);
    }

    public function testYear() :void
    {
        $result = $this->day->getDay();
        $this->assertEquals(2021, $result->year);
    }

    public function testMonth() :void
    {
        $result = $this->day->getDay();
        $this->assertIsObject($result->month);
    }

    public function testDay() :void
    {
        $result = $this->day->getDay();
        $this->assertEquals(1, $result->day);
    }

    public function testWeek() :void
    {
        $result = $this->day->getDay();
        $this->assertIsObject($result->dayOfWeek);
    }

    public function testDate() :void
    {
        $result = $this->day->getDay();
        $this->assertEquals("2021-01-01", $result->date);
    }

    public function testCarbon() :void
    {
        $result = $this->day->getDay();
        $this->assertIsObject($result->carbon);
    }

    public function testCurrentMonth() :void
    {
        $result = $this->day->getDay();
        $this->assertIsBool($result->currentMonth);
    }
}