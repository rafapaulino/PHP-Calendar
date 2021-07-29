<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Tightenco\Collect\Support\Collection;
use Carbon\Carbon;
use Calendar\Events;

class EventsTest extends TestCase
{
    protected Events $events;

    protected function setUp() :void
    {
        $this->events = new Events(1,2021);
    }

    public function testInstance() :void
    {
        $this->assertInstanceOf(Events::class, $this->events);
    }

    public function testTotalEvents() :void
    {
        $this->events->addEvent("Evento 01","2021-01-22", 1);
        $this->events->addEvent("Evento 02","2021-01-25", 2);
        $events = $this->events->getEvents();
        $this->assertEquals(4, count($events));
    }

    public function testYear() :void
    {
        $result = $this->events->getYear();
        $this->assertEquals(2021, $result);
    }

    public function testMonthInstance() :void
    {
        $month = $this->events->getMonth();
        $this->assertInstanceOf(stdClass::class, $month);
    }

    public function testMonthLetter() :void
    {
        $month = $this->events->getMonth();
        $this->assertEquals("J", $month->letter);
    }

    public function testMonthShortName() :void
    {
        $month = $this->events->getMonth();
        $this->assertEquals("Jan", $month->shortName);
    }

    public function testMonthFullName() :void
    {
        $month = $this->events->getMonth();
        $this->assertEquals("January", $month->fullName);
    }

    public function testMonthNumberInstance() :void
    {
        $month = $this->events->getMonth();
        $this->assertEquals(1, $month->number);
    }

    public function testWeekTotal() :void
    {
        $result = $this->events->getDaysWeek();
        $this->assertCount(7, $result);
    }

    public function testWeekContent() :void
    {
        $result = $this->events->getDaysWeek();
        $this->assertIsArray($result);
    }

    public function testWeekFirstDayContent() :void
    {
        $result = $this->events->getDaysWeek();
        $this->assertInstanceOf(stdClass::class, $result[0]);
    }

    public function testWeekFirstDayLetter() :void
    {
        $result = $this->events->getDaysWeek();
        $this->assertEquals("S", $result[0]->letter);
    }

    public function testWeekFirstDayShortName() :void
    {
        $result = $this->events->getDaysWeek();
        $this->assertEquals("Sun", $result[0]->shortName);
    }

    public function testWeekFirstDayFullName() :void
    {
        $result = $this->events->getDaysWeek();
        $this->assertEquals("Sunday", $result[0]->fullName);
    }

    public function testWeekFirstDayName() :void
    {
        $result = $this->events->getDaysWeek();
        $this->assertEquals("Sunday", $result[0]->name);
    }

    public function testWeekFirstDayIndex() :void
    {
        $result = $this->events->getDaysWeek();
        $this->assertEquals(0, $result[0]->index);
    }

    public function testDaysInstance() :void
    {
        $result = $this->events->getDays();
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testDaysTotal() :void
    {
        $result = $this->events->getDays();
        $this->assertCount(42, $result);
    }

    public function testDayContent() :void
    {
        $result = $this->events->getDays();
        $this->assertInstanceOf(stdClass::class, $result[0]);
    }

    public function testDayYear() :void
    {
        $result = $this->events->getDays();
        $this->assertEquals(2021, $result[0]->year);
    }

    public function testDayMonth() :void
    {
        $result = $this->events->getDays();
        $this->assertInstanceOf(stdClass::class, $result[0]->month);
    }

    public function testDay() :void
    {
        $result = $this->events->getDays();
        $this->assertEquals(27, $result[0]->day);
    }

    public function testDayWeek() :void
    {
        $result = $this->events->getDays();
        $this->assertInstanceOf(stdClass::class, $result[0]->dayOfWeek);
    }

    public function testDate() :void
    {
        $result = $this->events->getDays();
        $this->assertEquals("2020-12-27", $result[0]->date);
    }

    public function testCarbon() :void
    {
        $result = $this->events->getDays();
        $this->assertInstanceOf(Carbon::class, $result[0]->carbon);
    }

    public function testIsNotCurrentMonth() :void
    {
        $result = $this->events->getDays();
        $this->assertEquals(false, $result[0]->currentMonth);
    }

    public function testCurrentDate() :void
    {
        $result = $this->events->getDays();
        $this->assertEquals("2021-01-01", $result[5]->date);
    }

    public function testCurrentYear() :void
    {
        $result = $this->events->getDays();
        $this->assertEquals(2021, $result[5]->year);
    }

    public function testCurrentDay() :void
    {
        $result = $this->events->getDays();
        $this->assertEquals(1, $result[5]->day);
    }

    public function testIsCurrentMonth() :void
    {
        $result = $this->events->getDays();
        $this->assertEquals(true, $result[5]->currentMonth);
    }
}