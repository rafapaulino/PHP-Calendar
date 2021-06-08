<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Tightenco\Collect\Support\Collection;
use Carbon\Carbon;
use Calendar\Calendar;

class CalendarTest extends TestCase
{
    protected Calendar $calendar;

    protected function setUp() :void
    {
        $this->calendar = new Calendar(1,2021);
    }

    public function testMonthException() :void
    {
        $this->expectException(InvalidArgumentException::class);
        $calendar = new Calendar(50,2021);
    }

    public function testYearException() :void
    {
        $this->expectException(InvalidArgumentException::class);
        $calendar = new Calendar(1,-450);
    }

    public function testDayWeekException() :void
    {
        $this->expectException(InvalidArgumentException::class);
        $calendar = new Calendar(1,2021,300);
    }

    public function testInstance() :void
    {
        $this->assertInstanceOf(Calendar::class, $this->calendar);
    }

    public function testYear() :void
    {
        $result = $this->calendar->getYear();
        $this->assertEquals(2021, $result);
    }

    public function testMonthInstance() :void
    {
        $month = $this->calendar->getMonth();
        $this->assertInstanceOf(stdClass::class, $month);
    }

    public function testMonthLetter() :void
    {
        $month = $this->calendar->getMonth();
        $this->assertEquals("J", $month->letter);
    }

    public function testMonthShortName() :void
    {
        $month = $this->calendar->getMonth();
        $this->assertEquals("Jan", $month->shortName);
    }

    public function testMonthFullName() :void
    {
        $month = $this->calendar->getMonth();
        $this->assertEquals("January", $month->fullName);
    }

    public function testMonthNumberInstance() :void
    {
        $month = $this->calendar->getMonth();
        $this->assertEquals(1, $month->number);
    }

    public function testWeekTotal() :void
    {
        $result = $this->calendar->getDaysWeek();
        $this->assertCount(7, $result);
    }

    public function testWeekContent() :void
    {
        $result = $this->calendar->getDaysWeek();
        $this->assertIsArray($result);
    }

    public function testWeekFirstDayContent() :void
    {
        $result = $this->calendar->getDaysWeek();
        $this->assertInstanceOf(stdClass::class, $result[0]);
    }

    public function testWeekFirstDayLetter() :void
    {
        $result = $this->calendar->getDaysWeek();
        $this->assertEquals("S", $result[0]->letter);
    }

    public function testWeekFirstDayShortName() :void
    {
        $result = $this->calendar->getDaysWeek();
        $this->assertEquals("Sun", $result[0]->shortName);
    }

    public function testWeekFirstDayFullName() :void
    {
        $result = $this->calendar->getDaysWeek();
        $this->assertEquals("Sunday", $result[0]->fullName);
    }

    public function testWeekFirstDayName() :void
    {
        $result = $this->calendar->getDaysWeek();
        $this->assertEquals("Sunday", $result[0]->name);
    }

    public function testWeekFirstDayIndex() :void
    {
        $result = $this->calendar->getDaysWeek();
        $this->assertEquals(0, $result[0]->index);
    }

    public function testDaysInstance() :void
    {
        $result = $this->calendar->getDays();
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testDaysTotal() :void
    {
        $result = $this->calendar->getDays();
        $this->assertCount(42, $result);
    }

    public function testDayContent() :void
    {
        $result = $this->calendar->getDays();
        $this->assertInstanceOf(stdClass::class, $result[0]);
    }

    public function testDayYear() :void
    {
        $result = $this->calendar->getDays();
        $this->assertEquals(2021, $result[0]->year);
    }

    public function testDayMonth() :void
    {
        $result = $this->calendar->getDays();
        $this->assertInstanceOf(stdClass::class, $result[0]->month);
    }

    public function testDay() :void
    {
        $result = $this->calendar->getDays();
        $this->assertEquals(27, $result[0]->day);
    }

    public function testDayWeek() :void
    {
        $result = $this->calendar->getDays();
        $this->assertInstanceOf(stdClass::class, $result[0]->dayOfWeek);
    }

    public function testDate() :void
    {
        $result = $this->calendar->getDays();
        $this->assertEquals("2020-12-27", $result[0]->date);
    }

    public function testCarbon() :void
    {
        $result = $this->calendar->getDays();
        $this->assertInstanceOf(Carbon::class, $result[0]->carbon);
    }

    public function testIsNotCurrentMonth() :void
    {
        $result = $this->calendar->getDays();
        $this->assertEquals(false, $result[0]->currentMonth);
    }

    public function testCurrentDate() :void
    {
        $result = $this->calendar->getDays();
        $this->assertEquals("2021-01-01", $result[5]->date);
    }

    public function testCurrentYear() :void
    {
        $result = $this->calendar->getDays();
        $this->assertEquals(2021, $result[5]->year);
    }

    public function testCurrentDay() :void
    {
        $result = $this->calendar->getDays();
        $this->assertEquals(1, $result[5]->day);
    }

    public function testIsCurrentMonth() :void
    {
        $result = $this->calendar->getDays();
        $this->assertEquals(true, $result[5]->currentMonth);
    }
}