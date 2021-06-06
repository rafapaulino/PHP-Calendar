<?php
/**
 * This file is part of the Calendar package.
 *
 * PHP version 8
 *
 * @category PHP
 * @package  Calendar
 * @author   Rafael Paulino <rafaclasses@gmail.com>
 * @license  https://github.com/rafapaulino/PHP-Calendar/LICENSE BSD Licence
 * @link     https://github.com/rafapaulino/PHP-Calendar
 */

namespace Calendar;

use InvalidArgumentException;
use JetBrains\PhpStorm\Pure;
use stdClass;
use Tightenco\Collect\Support\Collection;
use Carbon\Carbon;

/**
 * Class Calendar
 *
 * @category PHP
 * @package  Calendar
 * @author   Rafael Paulino <rafaclasses@gmail.com>
 * @license  https://github.com/rafapaulino/PHP-Calendar/LICENSE BSD Licence
 * @link     https://github.com/rafapaulino/PHP-Calendar
 */
class Calendar implements CalendarInterface
{
    /**
     * Max days for subtract in calendar when number of days is set full
     *
     * @const int
     */
    const CALENDAR_MAX_DAYS = 41;

    /**
     * Return a collection with days in calendar
     *
     * @var Collection
     */
    protected mixed $days;
    /**
     * The last day in the month
     *
     * @var mixed
     */
    protected mixed $end;
    /**
     * The first day in the month
     *
     * @var mixed
     */
    protected mixed $start;
    /**
     * The year in calendar
     *
     * @var mixed
     */
    protected mixed $year;
    /**
     * The month in calendar
     *
     * @var mixed
     */
    protected mixed $month;
    /**
     * The days of week in calendar
     *
     * @var DaysWeek
     */
    protected DaysWeek $week;
    /**
     * Carbon object date for calendar construction
     *
     * @var mixed
     */
    protected mixed $date;

    /**
     * Calendar constructor.
     *
     * @param int  $month        month for this calendar
     * @param int  $year         year for the calendar
     * @param int  $firstDayWeek first day of week (0-6)
     * @param bool $full         show 42 days in calendar or show only days for complete this
     */
    public function __construct(int $month, int $year, int $firstDayWeek = 0, bool $full = true)
    {    
        if (!in_array($month, range(1, 12))) {  
            throw new InvalidArgumentException('The month must have a value between 1 and 12');
        }

        if (!checkdate(1, 1, $year)) {  
            throw new InvalidArgumentException('The year attribute needs a valid value');
        }     
        
        if (!in_array($firstDayWeek, range(0, 6))) {  
            throw new InvalidArgumentException('The first day of week must have a value between 0 and 6');
        }

        $this->week = new DaysWeek;
        
        //set first day of week
        if ($firstDayWeek > 0) {
            $this->week->setFirst($firstDayWeek);
        }

        $this->setMonth($month);
        $this->setYear($year);
        $this->setDate();
        $this->setStart();
        $this->setEnd($full);
        $this->setDays();
    }

    /**
     * Set month object for month number
     *
     * @param int $month actual month for calendar
     *
     * @return void
     */
    protected function setMonth(int $month): void
    {
        $months = new Months;
        $array_months = $months->getMonths()->all();

        $this->month = $array_months[$month];
    }

    /**
     * Return month object for actual month in calendar
     *
     * @return stdClass
     */
    public function getMonth(): stdClass
    {
        return $this->month;
    }

    /**
     * Set the year in calendar
     *
     * @param int $year the actual calendar year
     *
     * @return void
     */
    protected function setYear(int $year): void
    {       
        $this->year = $year;
    }

    /**
     * Return year for calendar
     *
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * Return a carbon date object
     *
     * @return Carbon
     */
    public function getDate(): Carbon
    {
        return $this->date;
    }

    /**
     * Create a carbon date object
     *
     * @return void
     */
    protected function setDate(): void
    {
        $year = $this->getYear();
        $month = $this->getMonth();
        $this->date = Carbon::createFromDate($year, $month->number, 1);
    }

    /**
     * Get an array with all days of week in std object
     *
     * @return array
     */
    #[Pure] public function getDaysWeek(): array
    {
        return $this->week->getDays()->all();
    }

    /**
     * Get the first day of calendar
     *
     * @return mixed
     */
    public function getStart(): mixed
    {
        return $this->start;
    }

    /**
     * Create the first day in calendar
     *
     * @return void
     */
    public function setStart(): void
    {
        // What is the index value (0-6) of the first day of the
        // month in question.
        $dayWeek = $this->date->dayOfWeek;
        $firstDayWeek = $this->week->getDays()->first();

        if ($dayWeek == $firstDayWeek->index) {
            $start = $this->date;
        } else {
            $start = $this->date->copy()->previous($firstDayWeek->name);
        }

        $this->start = $start->format('Y-m-d');
    }

    /**
     * Return the last day in calendar
     *
     * @return mixed
     */
    public function getEnd(): mixed
    {
        return $this->end;
    }

    /**
     * Create the last day in calendar
     *
     * @param $full boolean inform if calendar has 42 days or not
     *
     * @return void
     */
    public function setEnd(bool $full): void
    {
        $lastDayWeek = $this->week->getDays()->last();
        $end = $this->date->endOfMonth();
        // What is the index value (0-6) of the last day of the
        // month in question.
        $dayWeek = $end->dayOfWeek;

        if ($full) {
            $start = Carbon::createFromDate($this->getStart());
            $difference = $start->diffInDays($end);
            $days = Calendar::CALENDAR_MAX_DAYS - $difference;
            $end = $end->copy()->addDays($days);
        } else {
            if ($dayWeek == $lastDayWeek->index) {
                $end = $this->date;
            } else {
                $end = $this->date->copy()->next($lastDayWeek->name);
            }
        }

        $this->end = $end->format('Y-m-d');
    }


    /**
     * Create a collection of days for calendar
     *
     * @return void
     */
    public function setDays(): void
    {
        //get first day in calendar
        $start = $this->getStart();

        //get last day in calendar
        $end = $this->getEnd();

        $month = $this->getMonth();
        $year = $this->getYear();

        $days = array();
        $loop = 0;

        //create period
        $period = Carbon::parse($start)->toPeriod($end, '1 day');
        
        foreach ($period as $date) {
            $currentMonth = $date->format('m') == $month->number;
            $dayOfWeek = $this->setDayOfWeek($date->dayOfWeek);

            $day = new Day(
                $year,
                $month,
                $date->format('d'),
                $dayOfWeek,
                $date,
                $currentMonth
            );
            $days[$loop] = $day->getDay();
            
            $loop++;
        }

        $this->days = new Collection($days);
    }

    /**
     * Return a collection of days for calendar
     * 
     * @return Collection
     */
    public function getDays(): Collection
    {
        return $this->days;
    }

    /**
     * Set the first day of week in calendar
     *
     * @param int $dayOfWeek
     * 
     * @return mixed
     */
    #[Pure] protected function setDayOfWeek(int $dayOfWeek): mixed
    {
        foreach ($this->getDaysWeek() as $current) {
            if ($current->index == $dayOfWeek) {
                return $current;
            }
        }

        return 0;
    }
}
